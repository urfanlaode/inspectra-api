<?php

namespace Domain\Reference\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Infra\Imports\MasterImport;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ImportJob implements ShouldQueue
{
    use Queueable, Dispatchable, SerializesModels, InteractsWithQueue;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $filepath) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $mapping = config('imports.reference', []);
        $import = new MasterImport($mapping);

        $full = Storage::disk('local')->path($this->filepath);

        Excel::import($import, $full);
    }
}
