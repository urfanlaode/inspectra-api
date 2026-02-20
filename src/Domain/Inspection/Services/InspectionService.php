<?php

namespace Domain\Inspection\Services;

use Domain\Inspection\Data\InspectionData;
use Domain\Inspection\Models\Inspection;
use Domain\Inspection\Repositories\InspectionRepository;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class InspectionService
{
    public function __construct(
        protected InspectionRepository $inspectionRepository,
    ) {}

    public function storeInspection(InspectionData $data): Inspection
    {
        return $this->inspectionRepository->storeFromData($data);
    }

    public function updateInspection(InspectionData $data, int $id): Inspection
    {
        $inspection = $this->inspectionRepository->findById($id);

        if (!$inspection->status->isEditable()) {
            throw new UnprocessableEntityHttpException(
                'Inspection is not editable',
            );
        }

        return $this->inspectionRepository->updateFromData($inspection, $data);
    }

    public function allInspectionsWithLots()
    {
        return $this->inspectionRepository->allWithLots();
    }

    public function findInspectionWithLots(int $id): ?Inspection
    {
        return $this->inspectionRepository->findByIdWithLots($id);
    }
}
