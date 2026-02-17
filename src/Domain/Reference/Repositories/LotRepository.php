<?php

namespace Domain\Reference\Repositories;

use Domain\Reference\Data\LotData;
use Domain\Reference\Models\Lot;

class LotRepository implements LotRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function upsertFromData(LotData $data): void
    {
        Lot::updateOrCreate(
            ['id' => $data->id],
            [
                'item_id' => $data->item_id,
                'lot_number' => $data->lot_number,
                'allocation_id' => $data->allocation_id,
                'owner_id' => $data->owner_id,
                'condition_id' => $data->condition_id,
                'uom_id' => $data->uom_id,
                'qty' => $data->qty,
            ],
        );
    }
}
