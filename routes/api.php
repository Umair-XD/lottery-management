<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ApiSmsController;

Route::prefix('v1')->group(function () {
    // STEP 1: register → issues short-lived token to carry you through SMS step
    Route::post('register', [AuthController::class, 'store']);

    // Public: request a password‐reset OTP
    Route::post('password/forgot', [AuthController::class, 'sendResetOtp']);
    // Public: submit OTP + new password
    Route::post('password/reset',  [AuthController::class, 'resetPassword']);


    // STEP 2 & 3: submit mobile & verify OTP (must pass Bearer <temp_token>)
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('mobile',        [ApiSmsController::class, 'sendOtp']);
        Route::post('mobile/verify', [ApiSmsController::class, 'verifyOtp']);
    });

    // FINAL LOGIN / LOGOUT
    Route::post('login',  [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])
        ->middleware('auth:sanctum');
});
