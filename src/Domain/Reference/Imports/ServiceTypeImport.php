<?php

namespace Domain\Reference\Imports;

use Domain\Reference\Data\ServiceTypeData;
use Domain\Reference\Repositories\ServiceTypeRepository;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class ServiceTypeImport implements
    ToCollection,
    WithHeadingRow,
    WithChunkReading
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected ServiceTypeRepository $repo) {}

    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            try {
                $dto = ServiceTypeData::from($row);
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
