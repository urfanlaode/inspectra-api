<?php

namespace Domain\Reference\Repositories;

use Domain\Reference\Data\LotData;

interface LotRepositoryInterface
{
    public function upsertFromData(LotData $data): void;
}
