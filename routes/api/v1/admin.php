<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::prefix('sms_panel')->group(function () {
        Route::post('/', [\App\Http\Controllers\v1\SmsPanelController::class, 'store']);
        Route::post('/generateToken', [\App\Http\Controllers\v1\SmsController::class, 'generateToken']);

        Route::get('/{id}', [\App\Http\Controllers\v1\SmsPanelController::class, 'show']);
    });

    Route::prefix('providers')->group(function () {
        Route::get('/', [\App\Http\Controllers\v1\SmsController::class, 'getAllProviders']);
        Route::post('/change', [\App\Http\Controllers\v1\SmsController::class, 'setProviderOfDefault']);

    });
    Route::prefix('templates')->group(function () {
        Route::post('/', [\App\Http\Controllers\v1\TemplateController::class, 'store']);
        Route::get('/', [\App\Http\Controllers\v1\TemplateController::class, 'index']);
        Route::get('/{id}', [\App\Http\Controllers\v1\TemplateController::class, 'show']);
    });
});
Route::post('/send', [\App\Http\Controllers\v1\SmsController::class, 'send'])->middleware(\App\Http\Middleware\EnsureTokenIsValid::class);
