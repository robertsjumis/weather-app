<?php

namespace App\Services\WeatherDataFileReaders;

use App\Models\Reading;
use App\Services\Convertors\Distance;
use App\Services\Convertors\Temperature;
use DateTime;
use Illuminate\Support\Facades\Log;

class JSONReader extends FileReader implements FileReaderInterface
{
    public function __construct(string $fileName)
    {
        Log::debug("JSONReader::construct");
        parent::__construct($fileName);
    }

    // this function could be moved to parent class and reused between all reader
    // classes, if specific conversion rules were introduced for every class,
    // that would identify necessary data conversions for each dataset.
    public function parse()
    {
        Log::debug('JSONReader::parse()');
        $weather = json_decode($this->fileContents, true);
        foreach ($weather['data'] as $reading) {
            Reading::create([
                'station_id' => 1,
                'temp_celsius' => Temperature::fahrenheitToCelsius($reading['temp']),
                'humidity_percentage' => $reading['humidity'],
                'wind_kmh' => Distance::milesToKilometers($reading['wind']),
                'station_timestamp' => $reading['timestamp']
            ]);
        }

    }
}
