<?php
use App\Modules\Reference\Controllers\ImportController;
use App\Modules\Reference\Controllers\ReferenceController;
use Illuminate\Support\Facades\Route;

Route::get('', [ReferenceController::class, 'index'])->name('index');
Route::post('imports', [ImportController::class, 'import'])->name('import');
