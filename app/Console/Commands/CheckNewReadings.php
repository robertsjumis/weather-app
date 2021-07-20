<?php

namespace App\Console\Commands;

use App\Events\NewReadingEvent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CheckNewReadings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkNewReadings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Triggers an event when weather station reading
                              files have shown up in ./data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $fileList = Storage::disk('data')->allFiles();
        Log::debug("CheckNewReadings iteration!");
        Log::debug("files found: " . json_encode($fileList));
        if ($fileList) {
            event(new NewReadingEvent($fileList));
        }
    }
}
