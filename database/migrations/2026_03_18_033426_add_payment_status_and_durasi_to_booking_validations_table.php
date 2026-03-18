<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('booking_validations', function (Blueprint $table) {
            $table->enum('payment_status', ['pending', 'paid'])->default('pending')->after('nama_pemesan');
            $table->integer('durasi')->after('jam_selesai')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking_validations', function (Blueprint $table) {
            $table->dropColumn(['payment_status', 'durasi']);
        });
    }
};
