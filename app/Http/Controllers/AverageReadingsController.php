<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReadingResource;
use App\Models\Reading;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AverageReadingsController extends Controller
{
    public function show(Request $request)
    {
        // TODO input validation
        Log::debug("AverageReadingsController::show()");
        // TODO floor timestamp to start of the day - 00:00:00
        $timestamp = $request->get('timestamp');
        $readings = Reading::whereRaw("station_timestamp >= FROM_UNIXTIME($timestamp)")
            ->whereRaw("station_timestamp < FROM_UNIXTIME($timestamp) + INTERVAL 24 HOUR")
            ->get();
        Log::debug("Weather readings fetched!");
        $reading = $this->calculateAverage($readings);
        Log::debug("Average weather readings calculated!");
        return new ReadingResource($reading);

    }

    // TODO might extend Collection and create ReadingsCollection
    private function calculateAverage(Collection $readings): Reading
    {
        $averageReading = new Reading();
        foreach ($readings as $reading) {
            $averageReading->fill([
                'temp_celsius' => $averageReading->temp_celsius + $reading->temp_celsius,
                'wind_kmh' => $averageReading->wind_kmh + $reading->wind_kmh,
                'humidity_percentage' => $averageReading->humidity_percentage + $reading->humidity_percentage
            ]);
        }

        $readingsCount = $readings->count();
        $averageReading->fill([
            'temp_celsius' => $averageReading->temp_celsius / $readingsCount,
            'wind_kmh' => $averageReading->wind_kmh / $readingsCount,
            'humidity_percentage' => $averageReading->humidity_percentage / $readingsCount
        ]);
        return $averageReading;
    }
}
