<?php

namespace Domain\Reference\Data;

use Spatie\LaravelData\Data;

class AllocationData extends Data
{
    public function __construct(public int $id, public string $name) {}
}
