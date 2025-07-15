<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LapanganMode extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mode',
        'slot_sub',
        'is_full_lapangan',
        'deskripsi',
        'foto',
        'harga',
    ];

    /**
     * Relasi: Satu jenis mode bisa punya banyak booking
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
