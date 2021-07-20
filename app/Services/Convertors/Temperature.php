<?php

namespace App\Services\Convertors;

// reusable wrapper for temperature conversion functions
class Temperature
{
    public static function celsiusToFahrenheit(float $celsius): float
    {
        return ((9/5) * $celsius) + 32;
    }

    public static function fahrenheitToCelsius(float $fahrenheit): float
    {
        return ($fahrenheit - 32) * (5/9);
    }
}
