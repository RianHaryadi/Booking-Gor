<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Turnamen;
use Carbon\Carbon;

class TurnamenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $turnamens = [
            [
                'nama' => 'Jakarta Futsal Cup 2025',
                'deskripsi' => 'Turnamen futsal antar komunitas se-Jakarta dengan total hadiah puluhan juta rupiah.',
                'lokasi' => 'Elite Futsal Arena, Jakarta Timur',
                'tanggal_mulai' => Carbon::now()->addDays(30),
                'tanggal_selesai' => Carbon::now()->addDays(32),
                'poster' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=1586&auto=format&fit=crop',
                'kategori' => 'team',
                'hadiah' => 10000000,
                'status' => 'upcoming',
                'linkpendaftaran' => '#',
            ],
            [
                'nama' => 'Galaxy Badminton Single Championship',
                'deskripsi' => 'Kejuaraan bulutangkis tunggal putra dan putri tingkat regional.',
                'lokasi' => 'Galaxy Badminton Center, Jakarta Selatan',
                'tanggal_mulai' => Carbon::now()->addDays(15),
                'tanggal_selesai' => Carbon::now()->addDays(17),
                'poster' => 'https://images.unsplash.com/photo-1626224580175-3409133bd53c?q=80&w=1470&auto=format&fit=crop',
                'kategori' => 'single',
                'hadiah' => 5000000,
                'status' => 'upcoming',
                'linkpendaftaran' => '#',
            ],
            [
                'nama' => 'Cyber Basketball League',
                'deskripsi' => 'Liga basket semi-profesional yang berlangsung selama satu minggu.',
                'lokasi' => 'Cyber Basketball Court, Jakarta Timur',
                'tanggal_mulai' => Carbon::now()->subDays(10),
                'tanggal_selesai' => Carbon::now()->subDays(3),
                'poster' => 'https://images.unsplash.com/photo-1504450758481-7338eba7524a?q=80&w=1469&auto=format&fit=crop',
                'kategori' => 'team',
                'hadiah' => 15000000,
                'status' => 'completed',
                'linkpendaftaran' => '#',
            ],
        ];

        foreach ($turnamens as $turnamen) {
            Turnamen::create($turnamen);
        }
    }
}
