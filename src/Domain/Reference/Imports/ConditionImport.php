<?php

namespace Domain\Reference\Imports;

use Domain\Reference\Data\ConditionData;
use Domain\Reference\Repositories\ConditionRepository;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ConditionImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected ConditionRepository $repo) {}

    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            try {
                $dto = ConditionData::from($row);
                $this->repo->upsertFromData($dto);
            } catch (\Exception $e) {
                error_log('Condition import failed ' . $e->getMessage());
            }
        }
    }

    public function chunkSize(): int
    {
        return config('imports.chunk_size', 500);
    }
}
