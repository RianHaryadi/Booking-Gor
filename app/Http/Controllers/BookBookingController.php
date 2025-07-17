<?php

namespace App\Http\Controllers;

use App\Models\LapanganMode;
use App\Models\Booking;
use App\Models\BookingValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BookBookingController extends Controller
{
    public function index(Request $request)
    {
        $selectedDate = $request->input('date', Carbon::today()->toDateString());
        if (Carbon::parse($selectedDate)->isSunday()) {
            $selectedDate = Carbon::tomorrow()->toDateString();
        }

        $fields = LapanganMode::all()->map(function ($field) use ($selectedDate) {
            $field->availableTimeSlots = $this->getAvailableTimeSlots($field, $selectedDate);
            $field->isAvailable = !empty(array_filter($field->availableTimeSlots, fn($slot) => $slot['status'] === 'available'));
            Log::debug('Field pricing', [
                'field_id' => $field->id,
                'original_price' => $field->original_price
            ]);
            return $field;
        });

        return view('booking.index', compact('fields', 'selectedDate'));
    }

    private function getAvailableTimeSlots($field, $date)
    {
        $slots = [];
        $startHour = 8;
        $endHour = 22;
        $interval = 2;

        $bookings = Booking::where('tanggal', $date)
            ->where('lapangan_mode_id', $field->id)
            ->whereIn('status', ['booked', 'pending'])
            ->get(['jam_mulai', 'jam_selesai']);

        for ($hour = $startHour; $hour < $endHour; $hour += $interval) {
            $startTime = sprintf('%02d:00', $hour);
            $endTime = sprintf('%02d:00', $hour + $interval);

            $isBooked = $bookings->contains(function ($booking) use ($startTime, $endTime) {
                return $booking->jam_mulai <= $endTime && $booking->jam_selesai >= $startTime;
            });

            $status = $isBooked ? 'booked' : 
                     (Carbon::parse("$date $startTime")->isPast() ? 'soon' : 'available');

            $slots[] = [
                'time' => $startTime,
                'end_time' => $endTime,
                'status' => $status,
            ];
        }

        return $slots;
    }

    public function getTimeSlots(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'lapangan_mode_id' => 'required|exists:lapangan_modes,id',
                'date' => 'required|date|after_or_equal:today',
            ]);

            if ($validator->fails()) {
                Log::warning('Validation failed for time slots request', [
                    'errors' => $validator->errors()->toArray(),
                    'request' => $request->all()
                ]);
                return response()->json(['error' => $validator->errors()->first()], 422);
            }

            $field = LapanganMode::findOrFail($request->input('lapangan_mode_id'));
            $date = $request->input('date');

            if (Carbon::parse($date)->isSunday()) {
                return response()->json(['slots' => [], 'hargaPer2Jam' => $field->original_price ?? 10000], 200);
            }

            $slots = $this->getAvailableTimeSlots($field, $date);
            $hargaPer2Jam = $field->original_price ?? 10000;

            Log::info('Time slots fetched successfully', [
                'lapangan_mode_id' => $field->id,
                'date' => $date,
                'slots' => $slots,
                'hargaPer2Jam' => $hargaPer2Jam
            ]);

            return response()->json(['slots' => $slots, 'hargaPer2Jam' => $hargaPer2Jam], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching time slots', [
                'error' => $e->getMessage(),
                'lapangan_mode_id' => $request->input('lapangan_mode_id'),
                'date' => $request->input('date')
            ]);
            return response()->json(['error' => 'Failed to fetch time slots: ' . $e->getMessage()], 500);
        }
    }

    public function form(LapanganMode $field, Request $request)
    {
        $selectedDate = $request->input('date', Carbon::today()->toDateString());
        if (Carbon::parse($selectedDate)->isSunday()) {
            $selectedDate = Carbon::tomorrow()->toDateString();
        }

        $field->availableTimeSlots = $this->getAvailableTimeSlots($field, $selectedDate);
        Log::debug('Form pricing', [
            'field_id' => $field->id,
            'original_price' => $field->original_price
        ]);
        return view('booking.form', ['lapangan' => $field, 'selectedDate' => $selectedDate]);
    }

    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {
            try {
                Log::info('Starting booking store process', ['request_data' => $request->all()]);

                $validator = Validator::make($request->all(), [
                    'lapangan_mode_id' => 'required|exists:lapangan_modes,id',
                    'tanggal' => 'required|date|after_or_equal:today',
                    'jam_mulai' => 'required|date_format:H:i',
                    'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
                    'durasi' => 'required|in:2,4,6',
                    'nama_pemesan' => 'required|string|min:2|max:255',
                    'nomor_telepon' => 'required|string|regex:/^\+?\d{8,15}$/',
                    'email' => 'nullable|email|max:255',
                    'metode_pembayaran' => 'required|in:cash,transfer,qris',
                    'total_harga' => 'required|numeric|min:0',
                ]);

                if ($validator->fails()) {
                    Log::warning('Validation failed for booking store', [
                        'errors' => $validator->errors()->toArray(),
                        'request' => $request->all()
                    ]);
                    if ($request->expectsJson()) {
                        return response()->json(['error' => $validator->errors()->first()], 422);
                    }
                    return back()->withErrors($validator)->withInput();
                }

                $validated = $validator->validated();
                Log::debug('Validated data', ['validated' => $validated]);

                if (Carbon::parse($validated['tanggal'])->isSunday()) {
                    $error = ['tanggal' => 'GOR is closed on Sundays.'];
                    Log::warning('Sunday booking attempt', ['tanggal' => $validated['tanggal']]);
                    if ($request->expectsJson()) {
                        return response()->json(['error' => $error['tanggal']], 422);
                    }
                    return back()->withErrors($error)->withInput();
                }

                $jamMulai = Carbon::parse($validated['jam_mulai']);
                $jamSelesai = Carbon::parse($validated['jam_selesai']);
                $durasi = (int) $validated['durasi'];

                if ($jamSelesai->format('H:i') !== $jamMulai->copy()->addHours($durasi)->format('H:i')) {
                    $error = ['jam_selesai' => 'End time does not match duration.'];
                    Log::warning('Invalid end time', [
                        'jam_mulai' => $jamMulai->format('H:i'),
                        'jam_selesai' => $jamSelesai->format('H:i'),
                        'durasi' => $durasi
                    ]);
                    if ($request->expectsJson()) {
                        return response()->json(['error' => $error['jam_selesai']], 422);
                    }
                    return back()->withErrors($error)->withInput();
                }

                $startHour = (int) $jamMulai->format('H');
                $endHour = (int) $jamSelesai->format('H');
                if ($startHour < 8 || $endHour > 22) {
                    $error = ['jam_mulai' => 'Booking must be between 08:00–22:00.'];
                    Log::warning('Booking outside operational hours', [
                        'start_hour' => $startHour,
                        'end_hour' => $endHour
                    ]);
                    if ($request->expectsJson()) {
                        return response()->json(['error' => $error['jam_mulai']], 422);
                    }
                    return back()->withErrors($error)->withInput();
                }

                $field = LapanganMode::findOrFail($validated['lapangan_mode_id']);
                Log::debug('Fetched field', ['field_id' => $field->id, 'original_price' => $field->original_price]);

                $conflict = Booking::where('tanggal', $validated['tanggal'])
                    ->where('lapangan_mode_id', $field->id)
                    ->whereIn('status', ['booked', 'pending'])
                    ->where(function ($q) use ($jamMulai, $jamSelesai) {
                        $q->whereBetween('jam_mulai', [$jamMulai->format('H:i'), $jamSelesai->format('H:i')])
                          ->orWhereBetween('jam_selesai', [$jamMulai->format('H:i'), $jamSelesai->format('H:i')])
                          ->orWhere(function ($q2) use ($jamMulai, $jamSelesai) {
                              $q2->where('jam_mulai', '<=', $jamMulai->format('H:i'))
                                 ->where('jam_selesai', '>=', $jamSelesai->format('H:i'));
                          });
                    })
                    ->exists();

                if ($conflict) {
                    $error = ['jam_mulai' => 'This time slot is already booked.'];
                    Log::warning('Time slot conflict', [
                        'tanggal' => $validated['tanggal'],
                        'jam_mulai' => $jamMulai->format('H:i'),
                        'jam_selesai' => $jamSelesai->format('H:i')
                    ]);
                    if ($request->expectsJson()) {
                        return response()->json(['error' => $error['jam_mulai']], 422);
                    }
                    return back()->withErrors($error)->withInput();
                }

                $hargaPer2Jam = $field->original_price ?? 10000;
                $totalHarga = $hargaPer2Jam * ($durasi / 2);

                Log::info('Booking price calculation', [
                    'field_id' => $field->id,
                    'original_price' => $field->original_price,
                    'hargaPer2Jam' => $hargaPer2Jam,
                    'durasi' => $durasi,
                    'total_harga' => $totalHarga,
                    'client_total_harga' => $validated['total_harga']
                ]);

                if (abs($totalHarga - $validated['total_harga']) > 0.01) {
                    $error = ['total_harga' => 'Invalid total price.'];
                    Log::warning('Total price mismatch', [
                        'calculated' => $totalHarga,
                        'provided' => $validated['total_harga']
                    ]);
                    if ($request->expectsJson()) {
                        return response()->json(['error' => $error['total_harga']], 422);
                    }
                    return back()->withErrors($error)->withInput();
                }

                $status = in_array($validated['metode_pembayaran'], ['transfer', 'qris']) ? 'booked' : 'pending';
                $bookingData = [
                    'lapangan_mode_id' => $field->id,
                    'tanggal' => $validated['tanggal'],
                    'jam_mulai' => $jamMulai->format('H:i'),
                    'jam_selesai' => $jamSelesai->format('H:i'),
                    'durasi' => $durasi,
                    'nama_pemesan' => $validated['nama_pemesan'],
                    'nomor_telepon' => $validated['nomor_telepon'],
                    'email' => $validated['email'],
                    'metode_pembayaran' => $validated['metode_pembayaran'],
                    'total_harga' => $totalHarga,
                    'status' => $status,
                    'kode_booking' => 'BK-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5)),
                ];

                Log::debug('Attempting to create booking', ['booking_data' => $bookingData]);

                $booking = Booking::create($bookingData);
                Log::info('Booking created successfully', [
                    'booking_id' => $booking->id,
                    'kode_booking' => $booking->kode_booking
                ]);

                if ($status === 'booked') {
                    $validationData = [
                        'booking_id' => $booking->id,
                        'validated_by' => 'System',
                        'validated_at' => now(),
                    ];
                    Log::debug('Creating booking validation', ['validation_data' => $validationData]);
                    BookingValidation::create($validationData);
                    Log::info('Booking validation created', ['booking_id' => $booking->id]);
                }

                // Log session data setup
                Log::debug('Setting session data for booking', ['booking_id' => $booking->id, 'booking_data' => $booking->toArray()]);
                session()->put('booking', $booking);

                if ($request->expectsJson()) {
                    Log::info('Returning JSON response for AJAX request', ['booking_id' => $booking->id]);
                    return response()->json(['message' => 'Booking created successfully', 'booking_id' => $booking->id], 200);
                }

                Log::info('Redirecting to success page', ['booking_id' => $booking->id]);
                return redirect()->route('booking.success')->with('booking', $booking);
            } catch (\Exception $e) {
                Log::error('Booking creation failed', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                    'request_data' => $request->all()
                ]);
                if ($request->expectsJson()) {
                    return response()->json(['error' => 'Failed to create booking: ' . $e->getMessage()], 500);
                }
                return back()->withErrors(['error' => 'Failed to create booking: ' . $e->getMessage()])->withInput();
            }
        });
    }

    public function success()
    {
        $booking = session('booking');
        if (!$booking) {
            Log::warning('No booking data found in session for success page', ['session_data' => session()->all()]);
            return redirect()->route('booking.index')->with('error', 'No booking data found.');
        }
        Log::info('Rendering success page', ['booking_id' => $booking->id]);
        return view('booking.success', compact('booking'));
    }
}