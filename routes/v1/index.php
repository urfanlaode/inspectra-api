<?php
use App\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\Route;

Route::get('', function () {
    return ApiResponse::ok(['api' => 'v1']);
})->name('index');

Route::prefix('references')
    ->name('references.')
    ->group(base_path('routes/v1/reference.php'));

Route::prefix('inspections')
    ->name('inspections.')
    ->group(base_path('routes/v1/inspection.php'));

Route::fallback(function () {
    return ApiResponse::notFound('Resource not found');
})->name('fallback');
