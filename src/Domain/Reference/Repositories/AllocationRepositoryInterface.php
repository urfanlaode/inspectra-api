<?php

namespace Domain\Reference\Repositories;

use Domain\Reference\Data\AllocationData;
use Domain\Reference\Models\Allocation;

interface AllocationRepositoryInterface
{
    public function upsertFromData(AllocationData $data): void;
    public function findByName(string $name): ?Allocation;
}
