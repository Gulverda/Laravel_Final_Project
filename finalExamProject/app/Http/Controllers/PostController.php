<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // Return all posts as JSON
        return response()->json(Post::all());
    }

    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        // Create the new post
        $post = Post::create($request->all());

        // Return a success message
        return response()->json(['message' => 'Post created successfully!']);
    }

    public function show($id)
    {
        // Find the post by ID and return it, or return 404 if not found
        $post = Post::findOrFail($id);
        return response()->json($post);
    }
}
