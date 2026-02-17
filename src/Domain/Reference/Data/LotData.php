<?php

namespace Domain\Reference\Data;

use Spatie\LaravelData\Data;

class LotData extends Data
{
    public function __construct(
        public int $id,
        public int $item_id,
        public string $lot_number,
        public int $allocation_id,
        public int $owner_id,
        public int $condition_id,
        public int $uom_id,
        public int $qty,
    ) {}
}
