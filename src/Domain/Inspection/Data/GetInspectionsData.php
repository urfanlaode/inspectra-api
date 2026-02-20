<?php

namespace Domain\Inspection\Data;

use Domain\Inspection\Enums\InspectionStatus;
use Spatie\LaravelData\Data;

class GetInspectionsData extends Data
{
    public function __construct(public ?string $status = null) {}

    public function statuses(): ?array
    {
        if (!$this->status) {
            return null;
        }

        return match ($this->status) {
            'open' => [InspectionStatus::DRAFT, InspectionStatus::NEW],
            'in_review' => [InspectionStatus::READY_FOR_REVIEW],
            'completed' => [InspectionStatus::COMPLETED],
            default => null,
        };
    }
}
