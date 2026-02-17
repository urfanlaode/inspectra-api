<?php

namespace Domain\Reference\Imports;

use Domain\Reference\Data\ItemData;
use Domain\Reference\Repositories\ItemCategoryRepository;
use Domain\Reference\Repositories\ItemRepository;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ItemImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ItemRepository $repo,
        protected ItemCategoryRepository $itemCategoryRepo,
    ) {}

    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            try {
                $itemCategoryName = $row['category_name'] ?? null;
                $itemCategory = $this->itemCategoryRepo->findByName(
                    $itemCategoryName,
                );
                $row['item_category_id'] = $itemCategory?->id;

                $dto = ItemData::from($row);
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
