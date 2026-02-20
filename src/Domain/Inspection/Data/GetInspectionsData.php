<?php

namespace Domain\Inspection\Data;

use Domain\Inspection\Enums\InspectionStatus;
use Spatie\LaravelData\Data;

class GetInspectionsData extends Data
{
    public function __construct(public ?string $type = null) {}

    public function statuses(): ?array
    {
        if (!$this->type) {
            return null;
        }

        return match ($this->type) {
            'open' => [InspectionStatus::DRAFT, InspectionStatus::NEW],
            'ready_for_review' => [InspectionStatus::READY_FOR_REVIEW],
            'completed' => [InspectionStatus::COMPLETED],
            default => null,
        };
    }
}
