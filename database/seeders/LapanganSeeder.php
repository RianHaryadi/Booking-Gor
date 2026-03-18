<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LapanganMode;

class LapanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lapangans = [
            [
                'name' => 'Elite Futsal Arena',
                'location' => 'Jl. Pemuda No. 123, Jakarta Timur',
                'description' => 'Arena futsal dengan rumput sintetis berkualitas tinggi dan fasilitas ruang ganti yang lengkap.',
                'image' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=1586&auto=format&fit=crop',
                'original_price' => 150000,
                'category' => 'Premium',
                'rating' => 4.8,
                'sport_type' => 'futsal',
                'max_courts' => 1,
            ],
            [
                'name' => 'Cyber Basketball Court',
                'location' => 'Kawasan Industri Pulogadung, Jakarta Timur',
                'description' => 'Lapangan basket indoor dengan pencahayaan LED dan papan skor digital modern.',
                'image' => 'https://images.unsplash.com/photo-1504450758481-7338eba7524a?q=80&w=1469&auto=format&fit=crop',
                'original_price' => 200000,
                'category' => 'Premium',
                'rating' => 4.9,
                'sport_type' => 'basketball',
                'max_courts' => 1,
            ],
            [
                'name' => 'Galaxy Badminton Center',
                'location' => 'Jl. Pahlawan No. 45, Jakarta Selatan',
                'description' => 'Pusat bulutangkis dengan 3 lapangan karpet bertaraf internasional.',
                'image' => 'https://images.unsplash.com/photo-1626224580175-3409133bd53c?q=80&w=1470&auto=format&fit=crop',
                'original_price' => 50000,
                'category' => 'Standard',
                'rating' => 4.5,
                'sport_type' => 'badminton',
                'max_courts' => 3,
            ],
            [
                'name' => 'Victory Volleyball Court',
                'location' => 'Kawasan Olahraga Rawamangun, Jakarta Timur',
                'description' => 'Lapangan voli dengan lantai karet anti-slip dan jaring standar olimpiade.',
                'image' => 'https://images.unsplash.com/photo-1592656670411-dc95a8a19266?q=80&w=1470&auto=format&fit=crop',
                'original_price' => 80000,
                'category' => 'Standard',
                'rating' => 4.3,
                'sport_type' => 'volleyball',
                'max_courts' => 1,
            ],
            [
                'name' => 'Stadium Pro Futsal',
                'location' => 'Jl. Gatot Subroto No. 67, Jakarta Selatan',
                'description' => 'Stadium futsal megah dengan tribun penonton dan fasilitas kantin.',
                'image' => 'https://images.unsplash.com/photo-1575361204480-aadea25e6e68?q=80&w=1471&auto=format&fit=crop',
                'original_price' => 180000,
                'category' => 'Legendary',
                'rating' => 5.0,
                'sport_type' => 'futsal',
                'max_courts' => 1,
            ],
        ];

        foreach ($lapangans as $lapangan) {
            LapanganMode::create($lapangan);
        }
    }
}
