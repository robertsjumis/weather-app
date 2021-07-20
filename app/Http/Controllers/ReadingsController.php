<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReadingResource;
use App\Models\Reading;
use Illuminate\Http\Request;

class ReadingsController extends Controller
{
    public function show(Request $request)
    {
        // TODO input validation

        $stationId = $request->get('station_id');
        $timestamp = $request->get('timestamp');

        // TODO according to business needs - might implement solution where
        // the last reading is returned, if no reading is found by exact timestamp.
        $reading = Reading::where('station_id', $stationId)
                        ->whereRaw("station_timestamp = FROM_UNIXTIME($timestamp)")
                        ->get();
        return ReadingResource::collection($reading);
    }
}
