<?php

use App\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\Route;

Route::get('', function () {
    return ApiResponse::ok(['ver' => '0.0.1'], 'API is running');
})->name('index');

Route::prefix('v1')->name('api.v1.')->group(base_path('routes/v1/index.php'));

Route::fallback(function () {
    return ApiResponse::notFound('Resource not found');
})->name('fallback');
