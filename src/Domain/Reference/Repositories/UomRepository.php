<?php

namespace Domain\Reference\Repositories;

use Domain\Reference\Data\UomData;
use Domain\Reference\Models\Uom;

class UomRepository implements UomRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function upsertFromData(UomData $data): void
    {
        Uom::updateOrCreate(
            ['id' => $data->id],
            [
                'name' => $data->name,
            ],
        );
    }

    public function findByName(string $name): ?Uom
    {
        return Uom::where('name', $name)->first();
    }
}
