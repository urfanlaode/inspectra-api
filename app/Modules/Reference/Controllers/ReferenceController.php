<?php

namespace App\Modules\Reference\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\Request;
use Domain\Reference\Services\ReferenceService;

class ReferenceController extends Controller
{
    public function __construct(protected ReferenceService $referenceService) {}

    public function index(Request $request): mixed
    {
        $data = $this->referenceService->index();

        return ApiResponse::ok($data);
    }
}
