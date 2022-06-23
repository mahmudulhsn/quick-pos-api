<?php

use App\Http\Controllers\Api\AnalyticsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CustomerController;


Route::prefix("v1")->group(function () {
    // Route::post("register", [AuthController::class, "register"]);
    Route::post("login", [AuthController::class, "login"]);

    Route::middleware(["auth:api"])->group(function () {
        Route::get("user/info", [AuthController::class, "me"]);
        Route::post("logout", [AuthController::class, "logout"]);

        Route::resource('products', ProductController::class);
        Route::resource('customers', CustomerController::class);
        Route::resource('orders', OrderController::class);

        Route::get('analytics', [AnalyticsController::class, 'analytics']);
    });
});
