<?php

namespace App\Services\WeatherDataFileReaders;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

abstract class FileReader
{
    public const NAMESPACE = __NAMESPACE__ . '\\' ;
    protected string $fileContents;

    public function __construct(string $fileName)
    {
        $this->saveFileContents($fileName);
        $this->parse();
    }

    private function saveFileContents(string $fileName): void
    {
        $contents = Storage::disk('data')->get($fileName);
        // TODO: validations
        $this->fileContents = $contents;
    }
}
