<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::prefix('sms_panel')->group(function () {
        Route::post('/', [\App\Http\Controllers\v1\SmsPanelController::class, 'store']);
        Route::get('/send', [\App\Http\Controllers\v1\SmsController::class, 'send']);
        Route::get('/{id}', [\App\Http\Controllers\v1\SmsPanelController::class, 'show']);
    });
    Route::prefix('templates')->group(function () {
        Route::post('/', [\App\Http\Controllers\v1\TemplateController::class, 'store']);
    });
});
