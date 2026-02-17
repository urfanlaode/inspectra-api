<?php
use App\Modules\Reference\Controllers\ImportController;
use Illuminate\Support\Facades\Route;

Route::post('imports', [ImportController::class, 'import'])->name('import');
