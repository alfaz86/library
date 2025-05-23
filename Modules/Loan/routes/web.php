<?php

use Illuminate\Support\Facades\Route;
use Modules\Loan\Http\Controllers\LoanController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('loans', LoanController::class)->names('loan');
});
