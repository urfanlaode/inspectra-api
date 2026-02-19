<?php

namespace App\Modules\Reference\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\Request;
use Domain\Reference\Services\ReferenceService;

class ReferenceController extends Controller
{
    public function __construct(protected ReferenceService $referenceService) {}

    public function dropdowns(Request $request): mixed
    {
        $data = $this->referenceService->dropdowns();

        return ApiResponse::ok($data);
    }

    public function lots(Request $request): mixed
    {
        $data = $this->referenceService->lots();

        return ApiResponse::ok($data);
    }

    public function items(Request $request): mixed
    {
        $data = $this->referenceService->items();

        return ApiResponse::ok($data);
    }
}
