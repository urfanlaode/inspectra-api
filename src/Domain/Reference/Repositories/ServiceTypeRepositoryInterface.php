<?php

namespace Domain\Reference\Repositories;

use Domain\Reference\Data\ServiceTypeData;
use Domain\Reference\Models\ServiceType;

interface ServiceTypeRepositoryInterface
{
    public function upsertFromData(ServiceTypeData $data): void;
    public function findByName(string $name): ?ServiceType;
}
