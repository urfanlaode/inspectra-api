<?php

namespace Domain\Reference\Repositories;

use Domain\Reference\Data\ItemCategoryData;
use Domain\Reference\Models\ItemCategory;

class ItemCategoryRepository implements ItemCategoryRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function upsertFromData(ItemCategoryData $data): void
    {
        ItemCategory::updateOrCreate(
            ['id' => $data->id],
            [
                'name' => $data->name,
            ],
        );
    }

    public function findByName(string $name): ?ItemCategory
    {
        return ItemCategory::where('name', $name)->first();
    }

    public function allSelect()
    {
        return ItemCategory::select(['id', 'name'])->get();
    }
}
