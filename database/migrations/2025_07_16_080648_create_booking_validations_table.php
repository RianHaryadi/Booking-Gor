<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('booking_validations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->string('kode_booking'); // Referensi unik booking
            $table->string('status'); // Status booking saat validasi
            $table->decimal('total_harga', 10, 2); // Total harga saat validasi
            $table->date('tanggal'); // Tanggal booking
            $table->time('jam_mulai'); // Jam mulai booking
            $table->time('jam_selesai'); // Jam selesai booking
            $table->string('nama_pemesan'); // Nama pemesan saat validasi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_validations');
    }
};