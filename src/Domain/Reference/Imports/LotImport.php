<?php

namespace Domain\Reference\Imports;

use Domain\Reference\Data\LotData;
use Domain\Reference\Repositories\AllocationRepository;
use Domain\Reference\Repositories\ConditionRepository;
use Domain\Reference\Repositories\ItemRepository;
use Domain\Reference\Repositories\LotRepository;
use Domain\Reference\Repositories\OwnerRepository;
use Domain\Reference\Repositories\UomRepository;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LotImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected LotRepository $repo,
        protected ItemRepository $itemRepo,
        protected AllocationRepository $allocationRepo,
        protected OwnerRepository $ownerRepo,
        protected ConditionRepository $conditionRepo,
        protected UomRepository $uomRepo,
    ) {}

    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            try {
                $itemName = $row['item_name'] ?? null;
                $item = $this->itemRepo->findByName($itemName);
                $row['item_id'] = $item?->id;

                $allocationName = $row['allocation_name'] ?? null;
                $allocation = $this->allocationRepo->findByName(
                    $allocationName,
                );
                $row['allocation_id'] = $allocation?->id;

                $ownerName = $row['owner_name'] ?? null;
                $owner = $this->ownerRepo->findByName($ownerName);
                $row['owner_id'] = $owner?->id;

                $conditionName = $row['condition_name'] ?? null;
                $condition = $this->conditionRepo->findByName($conditionName);
                $row['condition_id'] = $condition?->id;

                $uomName = $row['uom_name'] ?? null;
                $uom = $this->uomRepo->findByName($uomName);
                $row['uom_id'] = $uom?->id;

                $dto = LotData::from($row);
                $this->repo->upsertFromData($dto);
            } catch (\Exception $e) {
                error_log('Lot import failed ' . $e->getMessage());
            }
        }
    }

    public function chunkSize(): int
    {
        return config('imports.chunk_size', 500);
    }
}
