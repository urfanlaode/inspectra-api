<?php
use App\Modules\Inspection\Controllers\InspectionController;
use Illuminate\Support\Facades\Route;

Route::get('', [InspectionController::class, 'allInspectionsWithLots'])->name(
    'allInspectionsWithLots',
);

Route::get('/{id}', [
    InspectionController::class,
    'findInspectionWithLots',
])->name('findInspectionWithLots');

Route::post('', [InspectionController::class, 'storeInspection'])->name(
    'storeInspection',
);

Route::put('/{id}', [InspectionController::class, 'updateInspection'])->name(
    'updateInspection',
);
