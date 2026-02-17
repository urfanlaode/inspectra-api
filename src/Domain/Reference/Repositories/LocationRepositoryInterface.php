<?php

namespace Domain\Reference\Repositories;

use Domain\Reference\Data\LocationData;
use Domain\Reference\Models\Location;

interface LocationRepositoryInterface
{
    public function upsertFromData(LocationData $data): void;
    public function findByName(string $name): ?Location;
}
