<?php

namespace Domain\Reference\Repositories;

use Domain\Reference\Data\ConditionData;
use Domain\Reference\Models\Condition;

interface ConditionRepositoryInterface
{
    public function upsertFromData(ConditionData $data): void;
    public function findByName(string $name): ?Condition;
    public function allSelect();
}
