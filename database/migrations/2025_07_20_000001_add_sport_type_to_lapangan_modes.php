<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSportTypeToLapanganModes extends Migration
{
    public function up()
    {
        Schema::table('lapangan_modes', function (Blueprint $table) {
            // sport_type: 'futsal', 'basketball', 'badminton', 'volleyball'
            $table->string('sport_type')->nullable()->after('category');
            // max_courts: badminton has 3, others have 1
            $table->integer('max_courts')->default(1)->after('sport_type');
        });
    }

    public function down()
    {
        Schema::table('lapangan_modes', function (Blueprint $table) {
            $table->dropColumn(['sport_type', 'max_courts']);
        });
    }
}
