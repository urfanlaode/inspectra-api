<?php

namespace Domain\Reference\Data;

use Spatie\LaravelData\Data;

class ScopeOfWorkData extends Data
{
    public function __construct(
        public int $id,
        public int $service_type_id,
        public string $name,
        public ?string $description,
    ) {}
}
