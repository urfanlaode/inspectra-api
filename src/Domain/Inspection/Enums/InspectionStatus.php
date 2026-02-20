<?php

namespace Domain\Inspection\Enums;

enum InspectionStatus: string
{
    case DRAFT = 'draft';
    case NEW = 'new';
    case READY_FOR_REVIEW = 'ready_for_review';
    case COMPLETED = 'completed';

    public function isEditable(): bool
    {
        return in_array($this, [self::DRAFT, self::NEW]);
    }
}
