<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
{
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();

        $table->foreignId('lapangan_mode_id')->constrained('lapangan_modes')->cascadeOnDelete();

        $table->date('tanggal');
        $table->time('jam_mulai');
        $table->time('jam_selesai');

        $table->string('nama_pemesan');
        $table->string('nomor_telepon')->nullable();
        $table->string('email')->nullable();

        $table->decimal('total_harga', 10, 2)->default(0);

        $table->string('kode_booking')->unique();
        $table->enum('metode_pembayaran', ['cash', 'transfer', 'qris'])->default('cash');

        $table->enum('status', ['booked', 'cancelled', 'completed'])->default('booked');

        $table->timestamps();

        $table->index(['lapangan_mode_id', 'tanggal', 'jam_mulai']);
    });
}

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
