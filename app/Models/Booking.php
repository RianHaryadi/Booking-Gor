<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'lapangan_mode_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'nama_pemesan',
        'nomor_telepon',
        'email',
        'status',
        'total_harga',
        'kode_booking',
        'metode_pembayaran',
        'status',
        'durasi',
    ];
   

    public function lapanganMode()
    {
        return $this->belongsTo(LapanganMode::class);
    }
    
     protected $casts = [
    'tanggal' => 'date',
    'jam_mulai' => 'datetime',
    'jam_selesai' => 'datetime',
];

    public function validation()
{
    return $this->hasOne(BookingValidation::class);
}


    public function scopeDiJamYangSama($query, $tanggal, $mulai, $selesai)
    {
        return $query->where('tanggal', $tanggal)
            ->where(function ($q) use ($mulai, $selesai) {
                $q->whereBetween('jam_mulai', [$mulai, $selesai])
                  ->orWhereBetween('jam_selesai', [$mulai, $selesai])
                  ->orWhere(function ($q2) use ($mulai, $selesai) {
                      $q2->where('jam_mulai', '<=', $mulai)
                         ->where('jam_selesai', '>=', $selesai);
                  });
            });
    }
}