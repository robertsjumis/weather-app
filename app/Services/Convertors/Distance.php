<?php

namespace App\Services\Convertors;

// reusable wrapper for distance conversion functions
class Distance
{
    public static function milesToKilometers(float $miles): float
    {
        return $miles / 1.609344;
    }

    public static function kilometersToMiles(float $km): float
    {
        return $km * 1.609344;
    }

    // TODO: implement inches - mm
}
