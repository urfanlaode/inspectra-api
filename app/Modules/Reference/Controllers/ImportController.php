<?php

namespace App\Modules\Reference\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Modules\Reference\Requests\StoreImportRequest;
use Domain\Reference\Services\ImportService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ImportController extends Controller
{
    public function __construct(protected ImportService $importService) {}

    public function import(StoreImportRequest $request): JsonResponse
    {
        $path = $this->importService->import($request->file('file'));

        return ApiResponse::ok(
            ['path' => $path],
            'Import queued',
            Response::HTTP_ACCEPTED,
        );
    }
}
