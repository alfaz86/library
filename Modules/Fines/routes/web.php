<?php

use Illuminate\Support\Facades\Route;
use Modules\Fines\Http\Controllers\FinesController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('fines', FinesController::class)->names('fines');
});
