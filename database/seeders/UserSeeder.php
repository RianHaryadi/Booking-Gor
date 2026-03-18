<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin Gor',
            'email' => 'admin@gor.com',
            'password' => Hash::make('password'),
        ]);

        // Regular user
        User::create([
            'name' => 'Rian Haryadi',
            'email' => 'rian@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
