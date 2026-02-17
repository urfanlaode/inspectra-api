<?php

namespace Domain\Reference\Repositories;

use Domain\Reference\Data\ItemData;
use Domain\Reference\Models\Item;

class ItemRepository implements ItemRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function upsertFromData(ItemData $data): void
    {
        Item::updateOrCreate(
            ['id' => $data->id],
            [
                'name' => $data->name,
                'item_category_id' => $data->item_category_id,
            ],
        );
    }

    public function findByName(string $name): ?Item
    {
        return Item::where('name', $name)->first();
    }

    public function findById(int $id): ?Item
    {
        return Item::where('id', $id)->first();
    }
}
