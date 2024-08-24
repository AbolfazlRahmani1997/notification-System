<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::prefix('sms_panel')->group(function () {
        Route::post('/', [\App\Http\Controllers\v1\SmsPanelController::class, 'store']);
        Route::get('/{id}', [\App\Http\Controllers\v1\SmsPanelController::class, 'show']);
    });
});
