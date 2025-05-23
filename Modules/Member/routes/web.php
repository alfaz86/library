<?php

use Illuminate\Support\Facades\Route;
use Modules\Member\Http\Controllers\MemberController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('members', MemberController::class)->names('member');
});
