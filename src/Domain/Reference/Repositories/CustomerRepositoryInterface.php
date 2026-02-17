<?php

namespace Domain\Reference\Repositories;

use Domain\Reference\Data\CustomerData;
use Domain\Reference\Models\Customer;

interface CustomerRepositoryInterface
{
    public function upsertFromData(CustomerData $data): void;
    public function findByName(string $name): ?Customer;
    public function allSelect();
}
