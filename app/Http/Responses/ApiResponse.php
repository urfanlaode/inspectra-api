<?php

namespace App\Http\Responses;

use Domain\Shared\Data\PaginationMeta;
use Domain\Shared\Enums\ErrorCode;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiResponse
{
    public static function ok(
        mixed $data = null,
        ?string $message = null,
        int $statusCode = 200,
    ): JsonResponse {
        $response = [
            'ok' => true,
            'timestamp' => now(),
            'message' => $message ?? __('app.ok'),
        ];

        if ($data) {
            $response['data'] = $data;
        }

        return response()->json($response, $statusCode);
    }

    public static function error(
        string $message,
        int $statusCode = 500,
        mixed $errors = null,
        ?string $errorCode = null,
    ): JsonResponse {
        $response = [
            'ok' => false,
            'timestamp' => now(),
            'message' => $message ?? __('app.error'),
        ];

        if ($errors) {
            $response['errors'] = $errors;
        }

        if ($errorCode) {
            $response['errorCode'] = $errorCode;
        }

        return response()->json($response, $statusCode);
    }

    public static function paginate(
        mixed $res,
        PaginationMeta $meta,
        ?string $message = null,
        int $statusCode = 200,
    ): JsonResponse {
        $response = [
            'ok' => true,
            'timestamp' => now(),
            'message' => $message ?? __('app.ok'),
            'data' => $res['data'],
            'meta' => $meta,
        ];

        return response()->json($response, $statusCode);
    }

    // Helpers

    public static function unauthorized(?string $message): JsonResponse
    {
        return self::error(
            empty($message) ? __('app.unauthorized') : $message,
            Response::HTTP_UNAUTHORIZED,
            null,
            ErrorCode::UNAUTHORIZED,
        );
    }

    public static function forbidden(?string $message): JsonResponse
    {
        return self::error(
            empty($message) ? __('app.forbidden') : $message,
            Response::HTTP_FORBIDDEN,
            null,
            ErrorCode::FORBIDDEN,
        );
    }

    public static function validationError(
        mixed $errors,
        ?string $message,
    ): JsonResponse {
        return self::error(
            empty($message) ? __('app.validation_failed') : $message,
            Response::HTTP_UNPROCESSABLE_ENTITY,
            $errors,
            ErrorCode::VALIDATION_ERROR,
        );
    }

    public static function notFound(?string $message): JsonResponse
    {
        return self::error(
            empty($message) ? __('app.not_found') : $message,
            Response::HTTP_NOT_FOUND,
            null,
            ErrorCode::NOT_FOUND,
        );
    }

    public static function serverError(?string $message): JsonResponse
    {
        return self::error(
            empty($message) ? __('app.server_error') : $message,
            Response::HTTP_INTERNAL_SERVER_ERROR,
            null,
            ErrorCode::SERVER_ERROR,
        );
    }
}
