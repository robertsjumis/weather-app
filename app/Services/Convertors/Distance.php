<?php

namespace App\Services\Convertors;

// reusable wrapper for distance conversion functions
use Illuminate\Support\Facades\Log;

class Distance
{
    public static function milesToKilometers(float $miles): float
    {
        Log::debug(" $miles Miles -> " .$miles / 1.609344." km");

        return $miles / 1.609344;
    }

    public static function kilometersToMiles(float $km): float
    {
        Log::debug("$km km -> " .$km * 1.609344." Miles");
        return $km * 1.609344;
    }

    // TODO: implement inches - mm
}
