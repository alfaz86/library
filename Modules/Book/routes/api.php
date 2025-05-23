<?php

use Illuminate\Support\Facades\Route;
use Modules\Book\Http\Controllers\BookController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('books', BookController::class)->names('book');
});
