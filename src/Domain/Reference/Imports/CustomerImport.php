<?php

namespace Domain\Reference\Imports;

use Domain\Reference\Data\CustomerData;
use Domain\Reference\Repositories\CustomerRepository;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomerImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected CustomerRepository $repo) {}

    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            try {
                $dto = CustomerData::from($row);
                $this->repo->upsertFromData($dto);
            } catch (\Exception $e) {
                error_log('Customer import failed ' . $e->getMessage());
            }
        }
    }

    public function chunkSize(): int
    {
        return config('imports.chunk_size', 500);
    }
}
