<?php

namespace Domain\Reference\Repositories;

use Domain\Reference\Data\UomData;
use Domain\Reference\Models\Uom;

interface UomRepositoryInterface
{
    public function upsertFromData(UomData $data): void;
    public function findByName(string $name): ?Uom;
    public function allSelect();
}
