<?php

use Illuminate\Support\Facades\Route;
use Modules\Fines\Http\Controllers\FinesController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('fines', FinesController::class)->names('fines');
});
