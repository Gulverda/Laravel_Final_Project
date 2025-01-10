<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Notifications\PostCreated; 
use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all(); 
        return view('posts.index', ['posts' => $posts]); 
    }

    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        // Get the authenticated user
        $user = auth()->user(); 

        // If no user is authenticated, return an error
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        // Create the new post
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $user->id, 
        ]);

        // Send a notification to the user
        Notification::send($user, new PostCreated()); 

        // Return a success message (you can redirect or return a JSON response)
        // return redirect()->route('posts.index'); 
        return response()->json(['message' => 'Post created successfully!'], 200); 
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return response()->json($post);
    }
}