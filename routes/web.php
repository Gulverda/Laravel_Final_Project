<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

// Home Route (optional, change as needed)
Route::get('/', function () {
    return view('welcome');
});

// Web Routes (non-API routes, handles views)
Route::get('/posts', [PostController::class, 'index'])->name('posts.index'); // Show posts
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create'); // Show create form

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // Login page
Route::post('/login', [AuthController::class, 'login'])->name('login.submit'); // Login action

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register'); // Register page
Route::post('/register', [AuthController::class, 'register'])->name('register.submit'); // Register action

// Logout Route
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

// Test Notification (for testing purposes)
Route::get('/send-test-notification', [PostController::class, 'sendTestNotification']);
