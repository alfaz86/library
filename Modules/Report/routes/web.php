<?php

use Illuminate\Support\Facades\Route;
use Modules\Report\Http\Controllers\ReportController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('reports', ReportController::class)->names('report');

    Route::get('/reports/print/{type}', [ReportController::class, 'print'])
        ->name('report.print');
});
