<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('filament.admin.pages.dashboard');
});

Route::view('/offline', 'offline')->name('offline');
