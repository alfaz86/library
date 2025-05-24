<?php

use Illuminate\Support\Facades\Route;
use Modules\LoanReturn\Http\Controllers\LoanReturnController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('returns', ReturnController::class)->names('return');
});
