<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;


Route::prefix("v1")->group(function () {
    // Route::post("register", [AuthController::class, "register"]);
    Route::post("login", [AuthController::class, "login"]);

    Route::middleware(["auth:api"])->group(function () {
        Route::get("user/info", [AuthController::class, "me"]);
        Route::post("logout", [AuthController::class, "logout"]);

        Route::resource('products', ProductController::class);
    });
});
