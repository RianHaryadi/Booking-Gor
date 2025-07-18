<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingValidation extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'kode_booking',
        'status',
        'total_harga',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'nama_pemesan',
        'validated_by',
        'validated_at',
        'durasi',
    ];

    protected $casts = [
        'validated_at' => 'datetime',
        'tanggal' => 'date',
        'jam_mulai' => 'datetime:H:i:s',
        'jam_selesai' => 'datetime:H:i:s',
        'total_harga' => 'decimal:2',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
