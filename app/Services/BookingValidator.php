<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\LapanganMode;

class BookingValidator
{
    public static function isAvailable($lapangan_mode_id, $tanggal, $jam_mulai, $jam_selesai, $sub_slot = null): bool
    {
        $mode = LapanganMode::findOrFail($lapangan_mode_id);

        $query = Booking::where('tanggal', $tanggal)
            ->where(function ($q) use ($jam_mulai, $jam_selesai) {
                $q->whereBetween('jam_mulai', [$jam_mulai, $jam_selesai])
                  ->orWhereBetween('jam_selesai', [$jam_mulai, $jam_selesai])
                  ->orWhere(function ($q2) use ($jam_mulai, $jam_selesai) {
                      $q2->where('jam_mulai', '<=', $jam_mulai)
                         ->where('jam_selesai', '>=', $jam_selesai);
                  });
            });

        if ($mode->is_full_lapangan) {
            // Booking full lapangan (futsal/basket)
            return !$query->exists();
        } else {
            // Booking split (voli/bulutangkis)
            return !$query->where(function ($q) use ($sub_slot) {
                $q->whereNull('sub_slot') // ada booking full? tabrakan
                  ->orWhere('sub_slot', $sub_slot); // slot yang sama juga bentrok
            })->exists();
        }
    }
}
