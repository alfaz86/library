<?php

use Illuminate\Support\Facades\Route;
use Modules\Book\Http\Controllers\BookController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('books', BookController::class)->names('book');
});
