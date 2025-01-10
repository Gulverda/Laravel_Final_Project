<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// Route to get the authenticated user's details
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// POST route for creating a post
Route::post('posts', [PostController::class, 'store']);

// GET route for fetching all posts
Route::get('posts', [PostController::class, 'index']);
