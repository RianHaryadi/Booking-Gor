<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lapangan_modes', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mode'); // Contoh: Lapangan Voli A, Bulutangkis B, Futsal
            $table->boolean('is_full_lapangan')->default(true); // Optional, bisa untuk informasi admin
            $table->decimal('harga', 10, 2)->default(0); // Harga sewa per 2 jam
            $table->text('deskripsi')->nullable(); // Informasi fasilitas
            $table->string('foto')->nullable(); // Path gambar fasilitas
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lapangan_modes');
    }
};
