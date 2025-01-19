<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Method to view a user's profile
    public function show($id)
    {
        // Fetch the user along with their profile
        $user = User::with('profile')->find($id);

        // Check if the user exists
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        
        
        // Return the user's profile data
        // return response()->json(data: $user->profile);

        
        // Return the profile view with the user and profile data
        return view('profile.show', [
            'user' => $user,
            'profile' => $user->profile  // You already have the profile as part of the user
        ]);
    }
}
