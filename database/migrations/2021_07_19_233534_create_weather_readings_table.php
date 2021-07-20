<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeatherReadingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_readings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('station_id');
            $table->integer('temp_celsius');
            $table->integer('humidity_percentage');
            $table->integer('wind_kmh');
            $table->timestamp('station_timestamp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather_readings');
    }
}
