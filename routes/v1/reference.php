<?php
use App\Modules\Reference\Controllers\ImportController;
use App\Modules\Reference\Controllers\ReferenceController;
use Illuminate\Support\Facades\Route;

Route::get('dropdowns', [ReferenceController::class, 'dropdowns'])->name(
    'dropdowns',
);
Route::get('lots', [ReferenceController::class, 'lots'])->name('lots');
Route::post('imports', [ImportController::class, 'import'])->name('import');
