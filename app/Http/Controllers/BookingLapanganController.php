<?php

namespace App\Http\Controllers;

use App\Models\LapanganMode;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class BookingLapanganController extends Controller
{
    public function index()
    {
        $lapangans = LapanganMode::all();
        return view('booking.index', compact('lapangans'));
    }

    public function store(Request $request)
    {
        try {
            // Validate the incoming request
            $validator = Validator::make($request->all(), [
                'lapangan_mode_id' => 'required|exists:lapangan_modes,id', // Updated to match table name
                'tanggal' => 'required|date|after_or_equal:today',
                'jam_mulai' => 'required|date_format:H:i',
                'durasi' => 'required|integer|in:2,4,6',
                'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
                'nama_pemesan' => 'required|string|max:255',
                'nomor_telepon' => 'nullable|string|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
                'email' => 'nullable|email|max:255',
                'metode_pembayaran' => 'required|in:cash,transfer,qris',
                'total_harga' => 'required|numeric|min:0',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Fetch the lapangan to verify price
            $lapangan = LapanganMode::findOrFail($request->lapangan_mode_id);

            // Calculate expected total harga based on duration
            $durasi = (int) $request->durasi;
            $expectedTotalHarga = $lapangan->harga * ($durasi / 2);

            // Validate total_harga matches expected value
            if (abs($request->total_harga - $expectedTotalHarga) > 0.01) {
                return redirect()->back()->withErrors(['total_harga' => 'Total harga tidak sesuai dengan durasi yang dipilih'])->withInput();
            }

            // Check operational hours and day
            $hari = (new \DateTime($request->tanggal))->format('w'); // 0 = Sunday, 6 = Saturday
            if ($hari == 0) {
                return redirect()->back()->withErrors(['tanggal' => 'GOR tutup pada hari Minggu'])->withInput();
            }

            $jamMulai = (int) explode(':', $request->jam_mulai)[0];
            $jamSelesai = (int) explode(':', $request->jam_selesai)[0];

            if ($jamMulai < 8 || $jamSelesai > 22) {
                return redirect()->back()->withErrors(['jam_mulai' => 'Booking harus dalam jam operasional 08:00 - 22:00'])->withInput();
            }

            // Check for booking conflicts
            $existingBooking = Booking::where('lapangan_mode_id', $request->lapangan_mode_id)
                ->where('tanggal', $request->tanggal)
                ->where(function ($query) use ($request) {
                    $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                          ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                          ->orWhere(function ($q) use ($request) {
                              $q->where('jam_mulai', '<=', $request->jam_mulai)
                                ->where('jam_selesai', '>=', $request->jam_selesai);
                          });
                })->exists();

            if ($existingBooking) {
                return redirect()->back()->withErrors(['jam_mulai' => 'Slot waktu ini sudah dibooking'])->withInput();
            }

            // Create the booking
            $booking = Booking::create([
                'lapangan_mode_id' => $request->lapangan_mode_id,
                'tanggal' => $request->tanggal,
                'jam_mulai' => $request->jam_mulai,
                'durasi' => $durasi,
                'jam_selesai' => $request->jam_selesai,
                'nama_pemesan' => $request->nama_pemesan,
                'nomor_telepon' => $request->nomor_telepon,
                'email' => $request->email,
                'metode_pembayaran' => $request->metode_pembayaran,
                'total_harga' => $request->total_harga,
                'status' => 'pending',
            ]);

            return redirect()->route('booking.success')->with('success', 'Booking berhasil dibuat!');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Booking creation failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat membuat booking. Silakan coba lagi.'])->withInput();
        }
    }

    public function success()
    {
        return view('booking.success');
    }
}