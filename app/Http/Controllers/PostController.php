<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Notifications\PostCreated;
use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{
    // Show all posts
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);
    }

    // Store new post
    public function store(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Get the authenticated user
        $user = auth()->user();

        // If no user is authenticated, return an error
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        // Create the new post
        $post = Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'user_id' => $user->id,
        ]);

        // Send a notification to the user
        Notification::send($user, new PostCreated());

        // Return a success message
        return response()->json(['message' => 'Post created successfully!'], 200);

        // Optionally, you could redirect to the index or another page:
        // return redirect()->route('posts.index');
    }

    // Show a specific post
    public function show($id)
    {
        // Find the post by ID or fail
        $post = Post::findOrFail($id);

        // Return the post as JSON (for API)
        return response()->json($post);
    }

    // Test notification (can be called directly)
    public function sendTestNotification()
    {
        $user = auth()->user(); // or get the first user
        Notification::send($user, new PostCreated());

        return response()->json(['message' => 'Test notification sent!']);
    }
}
