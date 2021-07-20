<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
    use HasFactory;

    //TODO: create station model and setup relationship with weather reading

    protected $table = 'weather_readings';

    protected $casts = [
        'station_timestamp' => 'datetime',
    ];

    protected $fillable = [
        'station_id',
        'temp_celsius',
        'humidity_percentage',
        'wind_kmh',
        'station_timestamp'
    ];
}
