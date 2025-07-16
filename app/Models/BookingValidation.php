<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingValidation extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'validated_by',
        'validated_at',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
