<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

// Registration and Login Routes
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// Authenticated Routes
Route::middleware('auth:sanctum')->get('user', [AuthController::class, 'me']);
Route::middleware('auth:sanctum')->post('/posts', [PostController::class, 'store']);