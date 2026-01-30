<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\CartController;

Route::prefix('v1')->group(function () {
    // Authentication
    Route::post('auth/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
    Route::post('auth/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
    Route::post('auth/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');

    Route::get('featured-menu', [MenuController::class, 'featured']);
    Route::get('menu', [MenuController::class, 'list']);

    // Reservations
    Route::get('reservations', [\App\Http\Controllers\Api\ReservationController::class, 'index'])->middleware('auth:sanctum');
    Route::post('reservations', [\App\Http\Controllers\Api\ReservationController::class, 'store']);
    Route::post('reservations/{id}/status', [\App\Http\Controllers\Api\ReservationController::class, 'updateStatus'])->middleware('auth:sanctum');

    // Orders / Checkout
    Route::post('checkout', [\App\Http\Controllers\Api\OrderController::class, 'checkout']);

    Route::get('cart', [CartController::class, 'get']);
    Route::post('cart/add', [CartController::class, 'add']);
    Route::post('cart/update', [CartController::class, 'update']);
    Route::post('cart/clear', [CartController::class, 'clear']);
});
