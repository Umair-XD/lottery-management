<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ApiSmsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TiresController;

Route::prefix('v1')->group(function () {
    Route::get('tires', [TiresController::class, 'apicall'])->name('tires.api.index');
    Route::get('tires/{id}', [TiresController::class, 'singleTicketapicall']);
    Route::get('products', [ProductController::class, 'apicall'])->name('products.api.index');
    Route::get('products/{id}', [ProductController::class, 'singleTicketapicall']);

    Route::post('register', [AuthController::class, 'store'])->middleware('throttle:5,1');
    Route::post('login',    [AuthController::class, 'login'])->middleware('throttle:5,1');

    Route::post('password/forgot', [AuthController::class, 'sendResetOtp'])->middleware('throttle:3,1');
    Route::post('password/reset',  [AuthController::class, 'resetPassword'])->middleware('throttle:3,1');

    Route::middleware(['auth:sanctum', 'throttle:3,1'])->group(function () {
        Route::post('mobile',        [ApiSmsController::class, 'sendOtp']);
        Route::post('mobile/verify', [ApiSmsController::class, 'verifyOtp']);
        Route::post('logout',        [AuthController::class, 'logout']);
    });
});
