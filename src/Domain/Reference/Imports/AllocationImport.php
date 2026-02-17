<?php

namespace Domain\Reference\Imports;

use Domain\Reference\Data\AllocationData;
use Domain\Reference\Repositories\AllocationRepository;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AllocationImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected AllocationRepository $repo) {}

    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            try {
                $dto = AllocationData::from($row);
                $this->repo->upsertFromData($dto);
            } catch (\Exception $e) {
                error_log('ServiceType import failed ' . $e->getMessage());
            }
        }
    }

    public function chunkSize(): int
    {
        return config('imports.chunk_size', 500);
    }
}
