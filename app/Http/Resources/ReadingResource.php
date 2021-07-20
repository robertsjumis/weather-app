<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReadingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'station_id' => $this->station_id,
            'temp_celsius' => $this->temp_celsius,
            'humidity_percentage' => $this->humidity_percentage,
            'wind_kmh' => $this->wind_kmh,
            'station_timestamp' => strtotime($this->station_timestamp)
        ];
    }
}
