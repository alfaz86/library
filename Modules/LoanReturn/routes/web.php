<?php

use Illuminate\Support\Facades\Route;
use Modules\LoanReturn\Http\Controllers\LoanReturnController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('returns', LoanReturnController::class)->names('return');
});
