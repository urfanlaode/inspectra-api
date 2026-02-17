<?php

namespace Domain\Reference\Imports;

use Domain\Reference\Data\OwnerData;
use Domain\Reference\Repositories\OwnerRepository;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OwnerImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected OwnerRepository $repo) {}

    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            try {
                $dto = OwnerData::from($row);
                $this->repo->upsertFromData($dto);
            } catch (\Exception $e) {
                error_log('Owner import failed ' . $e->getMessage());
            }
        }
    }

    public function chunkSize(): int
    {
        return config('imports.chunk_size', 500);
    }
}
