<?php

namespace App\Services\Convertors;

// reusable wrapper for temperature conversion functions
use Illuminate\Support\Facades\Log;

class Temperature
{
    public static function celsiusToFahrenheit(float $celsius): float
    {
        Log::debug("$celsius C -> " . ((9/5) * $celsius) + 32 . " F");
        return ((9/5) * $celsius) + 32;
    }

    public static function fahrenheitToCelsius(float $fahrenheit): float
    {
        Log::debug("$fahrenheit F -> " . ($fahrenheit - 32) * (5/9) . " C");
        return ($fahrenheit - 32) * (5/9);
    }
}
