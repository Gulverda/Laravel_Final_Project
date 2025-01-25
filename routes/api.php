<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {

    // Registration and Login Routes
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    
    // Authenticated Routes (requires Sanctum token)
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('user', [AuthController::class, 'me']);
        Route::post('posts', [PostController::class, 'store']); // Post creation
    });

    // Public Profile Route (no authentication required)
    Route::get('profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
});
