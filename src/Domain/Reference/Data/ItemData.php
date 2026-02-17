<?php

namespace Domain\Reference\Data;

use Spatie\LaravelData\Data;

class ItemData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public int $item_category_id,
    ) {}
}
