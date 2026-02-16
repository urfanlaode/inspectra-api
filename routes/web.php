<?php

use App\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ApiResponse::ok(null, 'It works!');
});
