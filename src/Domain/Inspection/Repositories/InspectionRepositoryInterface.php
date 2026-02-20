<?php

namespace Domain\Inspection\Repositories;

use Domain\Inspection\Models\Inspection;
use Domain\Inspection\Data\InspectionData;

interface InspectionRepositoryInterface
{
    public function storeFromData(InspectionData $data): Inspection;
}
