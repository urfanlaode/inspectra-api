<?php

namespace Domain\Reference\Repositories;

use Domain\Reference\Data\ServiceTypeData;
use Domain\Reference\Models\ServiceType;

class ServiceTypeRepository implements ServiceTypeRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function upsertFromData(ServiceTypeData $data): void
    {
        ServiceType::updateOrCreate(
            ['id' => $data->id],
            [
                'name' => $data->name,
            ],
        );
    }

    public function findByName(string $name): ?ServiceType
    {
        return ServiceType::where('name', $name)->first();
    }
}
