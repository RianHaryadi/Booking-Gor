<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\LapanganMode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function form(LapanganMode $lapangan)
    {
        return view('booking.form', compact('lapangan'));
    }

    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lapangan_mode_id' => 'required|exists:lapangan_modes,id',
            'nama_pemesan' => 'required|string',
            'nomor_telepon' => 'nullable|string',
            'email' => 'nullable|email',
            'tanggal' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'metode_pembayaran' => 'required|in:cash,transfer,qris',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $lapangan = LapanganMode::findOrFail($request->lapangan_mode_id);
        $tanggal = $request->tanggal;
        $mulai = $request->jam_mulai;
        $selesai = $request->jam_selesai;

        // Cek konflik jadwal lintas jenis lapangan
        $conflict = Booking::query()
            ->where('tanggal', $tanggal)
            ->where(function ($q) use ($mulai, $selesai) {
                $q->whereBetween('jam_mulai', [$mulai, $selesai])
                  ->orWhereBetween('jam_selesai', [$mulai, $selesai])
                  ->orWhere(function ($q2) use ($mulai, $selesai) {
                      $q2->where('jam_mulai', '<=', $mulai)
                         ->where('jam_selesai', '>=', $selesai);
                  });
            })
            ->where(function ($q) use ($lapangan) {
                if (in_array($lapangan->nama_mode, ['Voli A', 'Voli B', 'Voli C'])) {
                    $q->whereIn('lapangan_mode_id', LapanganMode::whereIn('nama_mode', ['Futsal', 'Basket', 'Badminton A', 'Badminton B', 'Badminton C'])->pluck('id'));
                } elseif (in_array($lapangan->nama_mode, ['Badminton A', 'Badminton B', 'Badminton C'])) {
                    $q->where('lapangan_mode_id', LapanganMode::where('nama_mode', str_replace('Badminton', 'Voli', $lapangan->nama_mode))->value('id'));
                } elseif (in_array($lapangan->nama_mode, ['Futsal', 'Basket'])) {
                    $q->whereIn('lapangan_mode_id', LapanganMode::whereIn('nama_mode', ['Voli A', 'Voli B', 'Voli C'])->pluck('id'));
                }
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors(['tanggal' => 'Waktu atau lapangan bentrok dengan booking lain.'])->withInput();
        }

        // Hitung durasi dan total harga
        $jamMulai = strtotime($mulai);
        $jamSelesai = strtotime($selesai);
        $durasiJam = ($jamSelesai - $jamMulai) / 3600;
        $totalHarga = $lapangan->harga * ($durasiJam / 2);

        // Simpan booking
        Booking::create([
            'lapangan_mode_id' => $lapangan->id,
            'nama_pemesan' => $request->nama_pemesan,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
            'tanggal' => $tanggal,
            'jam_mulai' => $mulai,
            'jam_selesai' => $selesai,
            'status' => 'booked',
            'total_harga' => $totalHarga,
            'kode_booking' => 'BK-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5)),
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        return redirect()->route('booking.index')->with('success', 'Booking berhasil dibuat!');
    }
}
