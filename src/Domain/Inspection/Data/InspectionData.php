<?php

namespace Domain\Inspection\Data;

use Domain\Inspection\Enums\InspectionStatus;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class InspectionData extends Data
{
    public function __construct(
        public ?string $inspection_no,
        public int $service_type_id,
        public int $scope_of_work_id,
        public int $location_id,
        public int $customer_id,
        public bool $is_customer_charged,
        public string $estimated_completion_date,
        public ?string $dc_code = null,
        public ?string $note = null,
        public ?InspectionStatus $status = null,

        /** @var DataCollection<int, InspectionItemData> */
        #[
            DataCollectionOf(InspectionItemData::class),
        ]
        public DataCollection $items,
    ) {}
}
