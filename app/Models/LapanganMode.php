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
        'sport_type',
        'max_courts',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Determines if this sport "locks" the entire arena (futsal, basketball)
     * or uses shared sub-courts (badminton - 3 sub-courts).
     */
    public function isArenaLockSport(): bool
    {
        return in_array(strtolower($this->sport_type ?? ''), ['futsal', 'basketball', 'basket']);
    }
}