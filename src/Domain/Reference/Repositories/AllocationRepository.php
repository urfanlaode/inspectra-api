<?php

namespace Domain\Reference\Repositories;

use Domain\Reference\Data\AllocationData;
use Domain\Reference\Models\Allocation;

class AllocationRepository implements AllocationRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function upsertFromData(AllocationData $data): void
    {
        Allocation::updateOrCreate(
            ['id' => $data->id],
            [
                'name' => $data->name,
            ],
        );
    }

    public function findByName(string $name): ?Allocation
    {
        return Allocation::where('name', $name)->first();
    }

    public function allSelect()
    {
        return Allocation::select(['id', 'name'])->get();
    }
}
