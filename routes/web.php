<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleServiceController;

// main page route for listing and search records
Route::get('/', [VehicleServiceController::class, 'index'])->name('services.index');

// add record form route
Route::post('/services/store', [VehicleServiceController::class, 'store'])->name('services.store');

// update record form route
Route::post('/services/update', [VehicleServiceController::class, 'update'])->name('services.update');

// delete record form route
Route::post('/services/delete', [VehicleServiceController::class, 'destroy'])->name('services.destroy');

