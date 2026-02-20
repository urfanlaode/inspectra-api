<?php

namespace Domain\Reference\Repositories;

use Domain\Reference\Data\ScopeOfWorkData;
use Domain\Reference\Models\ScopeOfWork;

class ScopeOfWorkRepository implements ScopeOfWorkRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function upsertFromData(ScopeOfWorkData $data): void
    {
        ScopeOfWork::updateOrCreate(
            ['id' => $data->id],
            [
                'service_type_id' => $data->service_type_id,
                'name' => $data->name,
                'description' => $data->description,
            ],
        );
    }

    public function allSelect()
    {
        return ScopeOfWork::with('service_type:id,name')
            ->select(['id', 'name', 'service_type_id', 'description'])
            ->get();
    }
}
