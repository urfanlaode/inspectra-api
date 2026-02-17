<?php

namespace Domain\Reference\Repositories;

use Domain\Reference\Data\ScopeOfWorkData;

interface ScopeOfWorkRepositoryInterface
{
    public function upsertFromData(ScopeOfWorkData $data): void;
    public function allSelect();
}
