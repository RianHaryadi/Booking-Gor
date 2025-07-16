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

class BookBookingController extends Controller
{
    public function index(Request $request)
    {
        $selectedDate = $request->input('date', Carbon::today()->toDateString());
        if (Carbon::parse($selectedDate)->isSunday()) {
            $selectedDate = Carbon::tomorrow()->toDateString();
        }

        $fields = LapanganMode::all();
        foreach ($fields as $field) {
            $field->availableTimeSlots = $this->getAvailableTimeSlots($field, $selectedDate);
            $field->isAvailable = !empty(array_filter($field->availableTimeSlots, fn($slot) => $slot['status'] === 'available'));
        }

        return view('booking.index', compact('fields', 'selectedDate'));
    }

    private function getAvailableTimeSlots($field, $date)
    {
        $slots = [];
        $startHour = 8;
        $endHour = 22;
        $interval = 2;

        for ($hour = $startHour; $hour < $endHour; $hour += $interval) {
            $startTime = sprintf('%02d:00', $hour);
            $endTime = sprintf('%02d:00', $hour + $interval);

            $isBooked = Booking::where('tanggal', $date)
                ->where('lapangan_mode_id', $field->id)
                ->where(function ($q) use ($startTime, $endTime) {
                    $q->whereBetween('jam_mulai', [$startTime, $endTime])
                      ->orWhereBetween('jam_selesai', [$startTime, $endTime])
                      ->orWhere(function ($q2) use ($startTime, $endTime) {
                          $q2->where('jam_mulai', '<=', $startTime)
                             ->where('jam_selesai', '>=', $endTime);
                      });
                })
                ->exists();

            $status = $isBooked
                ? 'booked'
                : (Carbon::parse("$date $startTime")->isPast() ? 'soon' : 'available');

            $slots[] = [
                'time' => $startTime,
                'end_time' => $endTime,
                'status' => $status,
            ];
        }

        return $slots;
    }

    public function form(LapanganMode $field, Request $request)
    {
        $selectedDate = $request->input('date', Carbon::today()->toDateString());
        if (Carbon::parse($selectedDate)->isSunday()) {
            $selectedDate = Carbon::tomorrow()->toDateString();
        }
        $field->availableTimeSlots = $this->getAvailableTimeSlots($field, $selectedDate);
        return view('booking.form', ['lapangan' => $field, 'selectedDate' => $selectedDate]);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'lapangan_mode_id' => 'required|exists:lapangan_modes,id',
                'tanggal' => 'required|date|after_or_equal:today',
                'jam_mulai' => 'required|date_format:H:i',
                'durasi' => 'required|in:2,4,6',
                'nama_pemesan' => 'required|string|max:255',
                'nomor_telepon' => 'nullable|string|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
                'email' => 'nullable|email|max:255',
                'metode_pembayaran' => 'required|in:cash,transfer,qris',
                'total_harga' => 'required|numeric|min:0',
            ], [
                'lapangan_mode_id.required' => 'Pilih lapangan terlebih dahulu.',
                'tanggal.after_or_equal' => 'Tanggal booking minimal hari ini.',
                'durasi.in' => 'Durasi harus 2, 4, atau 6 jam.',
                'nomor_telepon.regex' => 'Format nomor telepon tidak valid.',
                'total_harga.min' => 'Total harga tidak valid.',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $validated = $validator->validated();

            if (Carbon::parse($validated['tanggal'])->isSunday()) {
                return back()->withErrors(['tanggal' => 'GOR tutup pada hari Minggu.'])->withInput();
            }

            $jamMulai = Carbon::parse($validated['jam_mulai']);
            $durasi = (int) $validated['durasi'];
            $jamSelesai = $jamMulai->copy()->addHours($durasi);

            $startHour = (int) $jamMulai->format('H');
            $endHour = (int) $jamSelesai->format('H');
            if ($startHour < 8 || $endHour > 22) {
                return back()->withErrors(['jam_mulai' => 'Booking harus antara 08:00–22:00.'])->withInput();
            }

            $field = LapanganMode::findOrFail($validated['lapangan_mode_id']);

            $conflict = Booking::where('tanggal', $validated['tanggal'])
                ->where('lapangan_mode_id', $field->id)
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
                return back()->withErrors(['jam_mulai' => 'Slot waktu ini sudah dibooked.'])->withInput();
            }

            $hargaPer2Jam = $field->discounted_price ?? $field->harga;
            $totalHarga = $hargaPer2Jam * ($durasi / 2);

            if (abs($totalHarga - $validated['total_harga']) > 0.01) {
                return back()->withErrors(['total_harga' => 'Total harga tidak valid.'])->withInput();
            }

            // Tentukan status berdasarkan metode pembayaran
            $status = in_array($validated['metode_pembayaran'], ['transfer', 'qris']) ? 'booked' : 'pending';

            $booking = Booking::create([
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
            ]);

            // ✅ Tambahkan otomatis ke booking_validations jika status booked
            if ($status === 'booked') {
                BookingValidation::create([
                    'booking_id' => $booking->id,
                    'validated_by' => 'System',
                    'validated_at' => now(),
                ]);
            }

            return redirect()->route('booking.success')->with('booking', $booking);
        } catch (\Exception $e) {
            Log::error('Gagal membuat booking: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat membuat booking.'])->withInput();
        }
    }

    public function success()
    {
        $booking = session('booking');
        if (!$booking) {
            return redirect()->route('booking.index')->with('error', 'Tidak ada data booking ditemukan.');
        }
        return view('booking.success', compact('booking'));
    }
}
    