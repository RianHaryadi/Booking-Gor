<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LapanganMode extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'distance',
        'description',
        'image',
        'original_price',
        'discounted_price',
        'category',
        'rating',
        'latitude',
        'longitude',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}