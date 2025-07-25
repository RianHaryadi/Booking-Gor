<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLapanganModesTable extends Migration
{
    public function up()
    {
        Schema::create('lapangan_modes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->decimal('original_price', 10, 2);
            $table->string('category')->nullable();
            $table->float('rating')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lapangan_modes');
    }
}