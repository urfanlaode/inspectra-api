<?php

namespace Domain\Inspection\Data;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class InspectionItemData extends Data
{
    public function __construct(
        public int $item_id,
        public int $qty_requested,

        /** @var DataCollection<int, InspectionItemLotData> */
        #[
            DataCollectionOf(InspectionItemLotData::class),
        ]
        public DataCollection $lots = new DataCollection(
            InspectionItemLotData::class,
            [],
        ),
    ) {}
}
