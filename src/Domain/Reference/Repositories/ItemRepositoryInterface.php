<?php

namespace Domain\Reference\Repositories;

use Domain\Reference\Data\ItemData;
use Domain\Reference\Models\Item;

interface ItemRepositoryInterface
{
    public function upsertFromData(ItemData $data): void;
    public function findByName(string $name): ?Item;
    public function findById(int $id): ?Item;
    public function allSelect();
}
