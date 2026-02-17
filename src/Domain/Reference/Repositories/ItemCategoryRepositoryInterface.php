<?php

namespace Domain\Reference\Repositories;

use Domain\Reference\Data\ItemCategoryData;
use Domain\Reference\Models\ItemCategory;

interface ItemCategoryRepositoryInterface
{
    public function upsertFromData(ItemCategoryData $data): void;
    public function findByName(string $name): ?ItemCategory;
    public function allSelect();
}
