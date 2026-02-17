<?php

namespace Domain\Reference\Repositories;

use Domain\Reference\Data\OwnerData;
use Domain\Reference\Models\Owner;

interface OwnerRepositoryInterface
{
    public function upsertFromData(OwnerData $data): void;
    public function findByName(string $name): ?Owner;
    public function allSelect();
}
