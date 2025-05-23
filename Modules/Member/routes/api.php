<?php

use Illuminate\Support\Facades\Route;
use Modules\Member\Http\Controllers\MemberController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('members', MemberController::class)->names('member');
});
