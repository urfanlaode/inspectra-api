<?php

namespace Domain\Reference\Repositories;

use Domain\Reference\Data\OwnerData;
use Domain\Reference\Models\Owner;

class OwnerRepository implements OwnerRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function upsertFromData(OwnerData $data): void
    {
        Owner::updateOrCreate(
            ['id' => $data->id],
            [
                'name' => $data->name,
            ],
        );
    }

    public function findByName(string $name): ?Owner
    {
        return Owner::where('name', $name)->first();
    }
}
