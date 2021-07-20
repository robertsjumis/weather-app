<?php

namespace App\Services\WeatherDataFileReaders;

use App\Models\Reading;
use App\Services\Convertors\Distance;
use App\Services\Convertors\Temperature;
use DateTime;
use Illuminate\Support\Facades\Log;

class CSVReader extends FileReader implements FileReaderInterface
{
    const TIMESTAMP = 0;
    const TEMP = 1;
    const HUMIDITY = 2;
    const WIND = 3;

    public function __construct(string $fileName)
    {
        Log::debug("CSVReader::construct");
        parent::__construct($fileName);
    }

    // this function could be moved to parent class and reused between all reader
    // classes, if specific conversion rules were introduced for every class,
    // that would identify necessary data conversions for each dataset.
    public function parse()
    {
        Log::debug('CSVReader::parse()');
        $weather = explode(PHP_EOL, $this->fileContents);
        foreach ($weather as $reading) {
            if (!$reading) {
                continue;
            }
            $line = explode(';', $reading);
            Reading::create([
                'station_id' => 2,
                'temp_celsius' => $line[self::TEMP],
                'humidity_percentage' => $line[self::HUMIDITY],
                'wind_kmh' => $line[self::WIND],
                'station_timestamp' => DateTime::createFromFormat('d:m:Y, H:i:s', $line[self::TIMESTAMP])->getTimestamp()
            ]);
        }
    }
}
