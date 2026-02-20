<?php

namespace Domain\Inspection\Data;

use Spatie\LaravelData\Data;

class InspectionItemLotData extends Data
{
    public function __construct(
        public int $lot_id,
        public int $qty_required,
        public ?int $available_qty_snapshot = null,
    ) {}
}
