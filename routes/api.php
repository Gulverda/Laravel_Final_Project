<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;

Route::prefix('api')->group(function () {

    // Registration and Login Routes
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);


    
    // Authenticated Routes

    // Route::middleware('auth:sanctum')->get('user', [AuthController::class, 'me']);
    // Route::middleware('auth:sanctum')->post('/posts', [PostController::class, 'store']);


    Route::middleware('auth:sanctum')->group(function () {
        Route::get('user', [AuthController::class, 'me']);
        Route::post('/posts', [PostController::class, 'store']);
    });

    // Public Profile Route
    Route::get('profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
});
