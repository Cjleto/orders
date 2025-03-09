<?php

use App\Exceptions\RouteNotFound;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:login');

Route::middleware(['auth:sanctum','throttle:api'])->name('api.')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Rotte per i prodotti
    Route::apiResource('products', ProductController::class);

    // Rotte per i clienti
    Route::apiResource('customers', CustomerController::class);

    // Rotte per gli ordini
    Route::apiResource('orders', OrderController::class);
});

Route::fallback(function () {
    throw new RouteNotFound('Page Not Found.', 404);
})->name('fallback');
