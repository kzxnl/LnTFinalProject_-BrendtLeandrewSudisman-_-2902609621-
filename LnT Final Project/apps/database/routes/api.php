<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Public\ProductPublicController;
use App\Http\Controllers\Api\Admin\ProductAdminController;

// Endpoint Otentikasi
Route::post('/login', [AuthController::class, 'login']);

// Public API (Tanpa Middleware Auth)
Route::prefix('public')->group(function () {
    Route::get('/products', [ProductPublicController::class, 'index']);
    Route::get('/products/{id}', [ProductPublicController::class, 'show']);
});

// Admin API (Membutuhkan Bearer Token JWT)
Route::middleware('auth:api')->prefix('admin')->group(function () {
    Route::post('/refresh-token', [AuthController::class, 'refresh']);
    Route::apiResource('products', ProductAdminController::class);
});
