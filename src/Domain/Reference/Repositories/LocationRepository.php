<?php

namespace Domain\Reference\Repositories;

use Domain\Reference\Data\LocationData;
use Domain\Reference\Models\Location;

class LocationRepository implements LocationRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function upsertFromData(LocationData $data): void
    {
        Location::updateOrCreate(
            ['id' => $data->id],
            [
                'name' => $data->name,
            ],
        );
    }

    public function findByName(string $name): ?Location
    {
        return Location::where('name', $name)->first();
    }
}
