<?php

namespace Domain\Reference\Services;

use Domain\Reference\Jobs\ImportJob;
use Illuminate\Http\UploadedFile;

class ImportService
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function import(UploadedFile $file): string
    {
        $filename = 'reference.xlsx';

        $path = $file->storeAs('imports', basename($filename), 'local');

        ImportJob::dispatch($path);

        return $path;
    }
}
