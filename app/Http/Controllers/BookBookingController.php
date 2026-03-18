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
        $parsedDate = Carbon::parse($selectedDate)->setTimezone('Asia/Jakarta')->startOfDay();

        // Validate date is within 30 days
        $maxDate = Carbon::today()->addDays(30)->startOfDay();
        if ($parsedDate->gt($maxDate)) {
            return redirect()->route('booking.index', ['date' => Carbon::today()->toDateString()])
                            ->with('error', 'Tanggal tidak boleh lebih dari 30 hari ke depan.');
        }

        $fields = LapanganMode::all()->map(function ($field) use ($selectedDate) {
            $field->availableTimeSlots = $this->getAvailableTimeSlots($field, $selectedDate);
            $field->isAvailable = !empty(array_filter($field->availableTimeSlots, fn($slot) => $slot['status'] === 'available'));
            return $field;
        });

        return view('booking.index', compact('fields', 'selectedDate'));
    }

    private function getAvailableTimeSlots($field, $date)
    {
        $slots = [];
        $startHour = 8;  // 8:00 AM
        $endHour = 22;   // 10:00 PM
        $interval = 2;   // Fixed 2-hour slots

        $parsedDate = Carbon::parse($date)->setTimezone('Asia/Jakarta')->startOfDay();
        $isToday = $parsedDate->isToday();

        // Get all bookings for this field on this date
        $fieldBookings = Booking::where('tanggal', $parsedDate->toDateString())
            ->where('lapangan_mode_id', $field->id)
            ->whereIn('status', ['booked', 'pending'])
            ->select('jam_mulai', 'jam_selesai', 'nama_pemesan', 'nomor_telepon', 'email', 'total_harga', 'kode_booking', 'metode_pembayaran', 'durasi', 'status')
            ->get();

        for ($hour = $startHour; $hour < $endHour; $hour += $interval) {
            $startTime = sprintf('%02d:00:00', $hour);
            $endTime = sprintf('%02d:00:00', $hour + $interval);
            $slotStart = Carbon::parse("$date $startTime");
            $slotEnd = Carbon::parse("$date $endTime");

            // Check direct booking conflict for this field
            $booking = $fieldBookings->first(function ($booking) use ($startTime, $endTime) {
                return $booking->jam_mulai < $endTime && $booking->jam_selesai > $startTime;
            });

            $isPastSlot = $isToday && $slotStart->isPast();

            if ($booking) {
                $status = $booking->status;
            } elseif ($isPastSlot) {
                $status = 'soon';
            } else {
                $status = 'available';
            }

            $slots[] = [
                'time'               => substr($startTime, 0, 5),
                'end_time'           => substr($endTime, 0, 5),
                'status'             => $status,
                'nama_pemesan'       => $booking ? $booking->nama_pemesan : null,
                'nomor_telepon'      => $booking ? $booking->nomor_telepon : null,
                'email'              => $booking ? $booking->email : null,
                'total_harga'        => $booking ? $booking->total_harga : ($field->original_price * ($interval / 2)),
                'kode_booking'       => $booking ? $booking->kode_booking : null,
                'metode_pembayaran'  => $booking ? $booking->metode_pembayaran : null,
                'durasi'             => $booking ? $booking->durasi : $interval,
            ];
        }

        return $slots;
    }

    public function getTimeSlots(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'lapangan_mode_id' => 'required|exists:lapangan_modes,id',
                'date' => 'required|date|after_or_equal:today|before_or_equal:' . Carbon::today()->addDays(30)->toDateString(),
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()], 422);
            }

            $field = LapanganMode::findOrFail($request->input('lapangan_mode_id'));
            $date = $request->input('date');

            $slots = $this->getAvailableTimeSlots($field, $date);
            $hargaPer2Jam = $field->original_price ?? 10000;

            return response()->json(['slots' => $slots, 'hargaPer2Jam' => $hargaPer2Jam], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching time slots', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to fetch time slots: ' . $e->getMessage()], 500);
        }
    }

    public function form(LapanganMode $field, Request $request)
    {
        $selectedDate = $request->input('date', Carbon::today()->toDateString());
        $parsedDate = Carbon::parse($selectedDate)->setTimezone('Asia/Jakarta')->startOfDay();

        // Validate date is within 30 days
        $maxDate = Carbon::today()->addDays(30)->startOfDay();
        if ($parsedDate->gt($maxDate)) {
            return redirect()->route('booking.form', ['field' => $field->id, 'date' => Carbon::today()->toDateString()])
                            ->with('error', 'Tanggal tidak boleh lebih dari 30 hari ke depan.');
        }

        $bookingData = [
            'jam_mulai'         => $request->input('jam_mulai'),
            'jam_selesai'       => $request->input('jam_selesai'),
            'nama_pemesan'      => $request->input('nama_pemesan'),
            'nomor_telepon'     => $request->input('nomor_telepon'),
            'email'             => $request->input('email'),
            'total_harga'       => $request->input('total_harga'),
            'kode_booking'      => $request->input('kode_booking'),
            'metode_pembayaran' => $request->input('metode_pembayaran'),
            'durasi'            => $request->input('durasi', 2),
        ];

        $field->availableTimeSlots = $this->getAvailableTimeSlots($field, $selectedDate);

        return view('booking.form', [
            'lapangan'     => $field,
            'selectedDate' => $selectedDate,
            'bookingData'  => $bookingData,
        ]);
    }

    public function scheduleForm(Request $request)
    {
        $selectedDate = $request->input('date', Carbon::today()->toDateString());
        $parsedDate = Carbon::parse($selectedDate)->setTimezone('Asia/Jakarta')->startOfDay();

        // Validate date is within 30 days
        $maxDate = Carbon::today()->addDays(30)->startOfDay();
        if ($parsedDate->gt($maxDate)) {
            return redirect()->route('booking.schedule', ['date' => Carbon::today()->toDateString()])
                            ->with('error', 'Tanggal tidak boleh lebih dari 30 hari ke depan.');
        }

        $fields = LapanganMode::all()->map(function ($field) use ($selectedDate) {
            $field->availableTimeSlots = $this->getAvailableTimeSlots($field, $selectedDate);
            return $field;
        });

        return view('booking.schedule_form', compact('fields', 'selectedDate'));
    }

    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {
            try {
                Log::info('Starting booking store process', ['request_data' => $request->all()]);

                $validator = Validator::make($request->all(), [
                    'lapangan_mode_id' => 'required|exists:lapangan_modes,id',
                    'tanggal'          => 'required|date|after_or_equal:today|before_or_equal:' . Carbon::today()->addDays(30)->toDateString(),
                    'jam_mulai'        => 'required|date_format:H:i',
                    'jam_selesai'      => 'required|date_format:H:i|after:jam_mulai',
                    'durasi'           => 'required|in:2,4,6',
                    'nama_pemesan'     => 'required|string|min:2|max:255',
                    'nomor_telepon'    => 'required|string|regex:/^\+?(\d{8,15})$/',
                    'email'            => 'nullable|email|max:255',
                    'metode_pembayaran'=> 'required|in:cash,transfer,qris',
                    'total_harga'      => 'required|numeric|min:0',
                    'kode_booking'     => 'required|string|unique:bookings,kode_booking|max:20',
                ]);

                if ($validator->fails()) {
                    if ($request->expectsJson()) {
                        return response()->json(['error' => $validator->errors()->first()], 422);
                    }
                    return back()->withErrors($validator)->withInput();
                }

                $validated = $validator->validated();

                // Validate time and duration
                $jamMulai = Carbon::parse($validated['jam_mulai']);
                $jamSelesai = Carbon::parse($validated['jam_selesai']);
                $durasi = (int) $validated['durasi'];

                if ($jamSelesai->format('H:i') !== $jamMulai->copy()->addHours($durasi)->format('H:i')) {
                    $error = ['jam_selesai' => 'End time does not match duration.'];
                    if ($request->expectsJson()) return response()->json(['error' => $error['jam_selesai']], 422);
                    return back()->withErrors($error)->withInput();
                }

                // Check operational hours
                $startHour = (int) $jamMulai->format('H');
                $endHour   = (int) $jamSelesai->format('H');
                if ($startHour < 8 || $endHour > 22 || ($endHour === 22 && $jamSelesai->minute > 0)) {
                    $error = ['jam_mulai' => 'Booking must be between 08:00–22:00.'];
                    if ($request->expectsJson()) return response()->json(['error' => $error['jam_mulai']], 422);
                    return back()->withErrors($error)->withInput();
                }

                // Check direct time slot conflict
                $field = LapanganMode::findOrFail($validated['lapangan_mode_id']);
                $conflict = Booking::where('tanggal', $validated['tanggal'])
                    ->where('lapangan_mode_id', $field->id)
                    ->whereIn('status', ['booked', 'pending'])
                    ->where(function ($q) use ($jamMulai, $jamSelesai) {
                        $q->where('jam_mulai', '<', $jamSelesai->format('H:i'))
                          ->where('jam_selesai', '>', $jamMulai->format('H:i'));
                    })
                    ->exists();

                if ($conflict) {
                    $error = ['jam_mulai' => 'This time slot is already booked.'];
                    if ($request->expectsJson()) return response()->json(['error' => $error['jam_mulai']], 422);
                    return back()->withErrors($error)->withInput();
                }

                // Check cross-sport conflict


                // Calculate price
                $hargaPer2Jam = $field->original_price ?? 10000;
                $totalHarga = $hargaPer2Jam * ($durasi / 2);

                if (abs($totalHarga - $validated['total_harga']) > 0.01) {
                    $error = ['total_harga' => 'Invalid total price. Expected: ' . $totalHarga];
                    if ($request->expectsJson()) return response()->json(['error' => $error['total_harga']], 422);
                    return back()->withErrors($error)->withInput();
                }

                $status = in_array($validated['metode_pembayaran'], ['transfer', 'qris']) ? 'booked' : 'pending';
                $kodeBooking = $validated['kode_booking'];

                $bookingData = [
                    'lapangan_mode_id'  => $field->id,
                    'tanggal'           => $validated['tanggal'],
                    'jam_mulai'         => $jamMulai->format('H:i'),
                    'jam_selesai'       => $jamSelesai->format('H:i'),
                    'durasi'            => $durasi,
                    'nama_pemesan'      => $validated['nama_pemesan'],
                    'nomor_telepon'     => $validated['nomor_telepon'],
                    'email'             => $validated['email'],
                    'metode_pembayaran' => $validated['metode_pembayaran'],
                    'total_harga'       => $totalHarga,
                    'status'            => $status,
                    'kode_booking'      => $kodeBooking,
                ];

                $booking = Booking::create($bookingData);
                Log::info('Booking created successfully', ['booking_id' => $booking->id]);

                $paymentStatus = in_array($booking->metode_pembayaran, ['transfer', 'qris']) ? 'paid' : 'pending';
                $booking->update(['payment_status' => $paymentStatus]);

                BookingValidation::create([
                    'booking_id'      => $booking->id,
                    'kode_booking'    => $booking->kode_booking,
                    'status'          => $booking->status,
                    'total_harga'     => $booking->total_harga,
                    'tanggal'         => $booking->tanggal,
                    'jam_mulai'       => $booking->jam_mulai,
                    'jam_selesai'     => $booking->jam_selesai,
                    'durasi'          => $booking->durasi,
                    'nama_pemesan'    => $booking->nama_pemesan,
                    'payment_status'  => $paymentStatus,
                ]);

                session()->put('booking', $booking);

                if ($request->expectsJson()) {
                    return response()->json([
                        'message'      => 'Booking created successfully',
                        'booking_id'   => $booking->id,
                        'kode_booking' => $booking->kode_booking,
                    ], 200);
                }

                return redirect()->route('booking.success')->with('booking', $booking);
            } catch (\Exception $e) {
                Log::error('Booking creation failed', ['error' => $e->getMessage()]);
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
            return redirect()->route('booking.index')->with('error', 'No booking data found.');
        }
        return view('booking.success', compact('booking'));
    }
}