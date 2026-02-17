<?php

namespace Domain\Reference\Repositories;

use Domain\Reference\Data\ConditionData;
use Domain\Reference\Models\Condition;

class ConditionRepository implements ConditionRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function upsertFromData(ConditionData $data): void
    {
        Condition::updateOrCreate(
            ['id' => $data->id],
            [
                'name' => $data->name,
            ],
        );
    }

    public function findByName(string $name): ?Condition
    {
        return Condition::where('name', $name)->first();
    }

    public function allSelect()
    {
        return Condition::select(['id', 'name'])->get();
    }
}
