<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lapangan_mode_id')->constrained()->onDelete('cascade');
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('nama_pemesan');
            $table->string('nomor_telepon')->nullable();
            $table->string('email')->nullable();
            $table->enum('status', ['pending', 'booked', 'cancelled', 'completed'])->default('pending');
            $table->decimal('total_harga', 10, 2);
            $table->string('kode_booking')->unique();
            $table->string('metode_pembayaran');
            $table->integer('durasi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}