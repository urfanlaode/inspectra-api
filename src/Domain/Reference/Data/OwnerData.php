<?php

namespace Domain\Reference\Data;

use Spatie\LaravelData\Data;

class OwnerData extends Data
{
    public function __construct(public int $id, public string $name) {}
}
