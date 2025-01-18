<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;  // <-- Add this line

// Route to get the authenticated user's details
Route::middleware('jwt.auth')->get('/user', function (Request $request) {
    return $request->user();
});

// POST route for creating a post
Route::post('posts', [PostController::class, 'store']);

// GET route for fetching all posts
Route::get('posts', [PostController::class, 'index']);

// Protected routes using JWT
Route::group(['middleware' => ['jwt.auth']], function () {
    Route::get('user', [AuthController::class, 'me']);
    // Add other protected routes here
});
