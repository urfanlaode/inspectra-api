<?php
use App\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\Route;

Route::get('', function () {
    return ApiResponse::ok(['api' => 'v1']);
})->name('index');

Route::fallback(function () {
    return ApiResponse::notFound('Resource not found');
})->name('fallback');
