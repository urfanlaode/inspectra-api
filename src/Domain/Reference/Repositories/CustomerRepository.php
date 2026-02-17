<?php

namespace Domain\Reference\Repositories;

use Domain\Reference\Data\CustomerData;
use Domain\Reference\Models\Customer;

class CustomerRepository implements CustomerRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function upsertFromData(CustomerData $data): void
    {
        Customer::updateOrCreate(
            ['id' => $data->id],
            [
                'name' => $data->name,
            ],
        );
    }

    public function findByName(string $name): ?Customer
    {
        return Customer::where('name', $name)->first();
    }
}
