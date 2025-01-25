<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($id)
    {
        $user = User::with('profile')->find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        
        
        // Return the user's profile data
        // return response()->json(data: $user->profile);

        
        // Return the profile view with the user and profile data
        return view('profile.show', [
            'user' => $user,
            'profile' => $user->profile 
        ]);
    }
}
