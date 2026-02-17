<?php

namespace Domain\Reference\Imports;

use Domain\Reference\Data\ItemCategoryData;
use Domain\Reference\Repositories\ItemCategoryRepository;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ItemCategoryImport implements
    ToCollection,
    WithHeadingRow,
    WithChunkReading
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected ItemCategoryRepository $repo) {}

    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            try {
                $dto = ItemCategoryData::from($row);
                $this->repo->upsertFromData($dto);
            } catch (\Exception $e) {
                error_log('ItemCategory import failed ' . $e->getMessage());
            }
        }
    }

    public function chunkSize(): int
    {
        return config('imports.chunk_size', 500);
    }
}
