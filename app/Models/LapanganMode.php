<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LapanganMode extends Model
{
    use HasFactory;
    
    protected $table = 'lapangan_modes';
    protected $fillable = [
        'name',
        'location',
        'description',
        'image',
        'original_price',
        'category',
        'rating',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}