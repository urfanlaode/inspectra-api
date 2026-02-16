<?php

namespace Domain\Shared\Data;

use Spatie\LaravelData\Data;

class PaginationMeta extends Data
{
    public function __construct(
        public int $page,
        public int $limit,
        public ?int $next = null,
        public ?int $prev = null,
    ) {}
}
