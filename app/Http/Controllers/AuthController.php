<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login submission with Sanctum
    public function login(LoginRequest $request)
    {
        // Check if the credentials are valid
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            // Traditional login for web
            return redirect()->intended('/posts');
        }
    
        // For API authentication using Sanctum
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        // Generate Sanctum token
        $token = $user->createToken('TestToken')->plainTextToken;
    
        return response()->json(['token' => $token]);
    }

    // Show the registration form
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Handle registration submission
    public function register(RegisterRequest $request)
    {
        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
    
        // Log the user in traditionally
        Auth::login($user);
    
        // Generate Sanctum token for API users
        $token = $user->createToken('TestToken')->plainTextToken;
    
        // Return the token in the response
        return response()->json(['token' => $token], 201);
    }

    // Get the authenticated user's profile (Sanctum-based)
    public function me()
    {
        return response()->json(auth()->user());
    }
}
