<?php

namespace App\Modules\Inspection\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use Domain\Inspection\Data\InspectionData;
use Domain\Inspection\Services\InspectionService;
use App\Modules\Inspection\Requests\StoreInspectionRequest;
use Illuminate\Http\Request;
use App\Modules\Inspection\Requests\GetInspectionsRequest;
use Domain\Inspection\Data\GetInspectionsData;

class InspectionController extends Controller
{
    public function __construct(
        protected InspectionService $inspectionService,
    ) {}

    public function storeInspection(StoreInspectionRequest $request)
    {
        $dto = InspectionData::from($request->all());

        $single = $this->inspectionService->storeInspection($dto);

        return ApiResponse::ok($single, 'Inspection stored successfully');
    }

    public function updateInspection(StoreInspectionRequest $request, int $id)
    {
        $dto = InspectionData::from($request->all());

        $single = $this->inspectionService->updateInspection($dto, $id);

        return ApiResponse::ok($single, 'Inspection updated successfully');
    }

    public function allInspectionsWithLots(GetInspectionsRequest $request)
    {
        $dto = GetInspectionsData::from($request->validated());

        $data = $this->inspectionService->allInspectionsWithLots($dto);

        // TODO: paginate

        return ApiResponse::ok($data, 'Inspections retrieved successfully');
    }

    public function findInspectionWithLots(Request $request, int $id)
    {
        $data = $this->inspectionService->findInspectionWithLots($id);

        if (!$data) {
            return ApiResponse::notFound('Inspection not found');
        }

        return ApiResponse::ok($data, 'Inspection retrieved successfully');
    }
}
