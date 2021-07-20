<?php

namespace App\Listeners;

use App\Events\NewReadingEvent;
use App\Services\WeatherDataFileReaders\FileReader;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class HandleNewReadings
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewReadingEvent  $event
     * @return void
     */
    public function handle(NewReadingEvent $event)
    {
        Log::debug("HandleNewReadings->handle()");
        foreach ($event->fileList as $fileName) {
            Log::debug($fileName);
            // For now it's possible to classify files by file extension. Problems
            // will arise if new stations show up and they send different datasets
            // (different payloads) using the same file extensions.
            // In that case probably a specific Reader class should be made for
            // each type of dataset, and an additional Filter class should be made
            // to identify Reader class for reading / parsing the file.
            $fileExtension = strtoupper(pathinfo($fileName, PATHINFO_EXTENSION));
            $readerClassName = FileReader::NAMESPACE . $fileExtension . 'Reader';
            $reader = new $readerClassName($fileName);

            // TODO implement validatons / exception handling in Reader classes to
            // check if readings were saved successfully. If not, save file in dedicated
            // directory and send out an warning email to system admin.
            Log::debug("deleting file " . $fileName);
            Storage::disk('data')->delete($fileName);


        }

    }
}
