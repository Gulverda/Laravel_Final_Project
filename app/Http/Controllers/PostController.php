<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Notifications\PostCreated;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\PostRequest;  // Include the PostRequest

class PostController extends Controller
{
    // Show all posts
    public function index()
    {
        // Retrieve posts with their tags and the user who created them
        $posts = Post::with('tags', 'user')->get();

        // Retrieve all available tags
        $tags = Tag::all();

        // Pass both posts and tags to the view
        return view('posts.index', compact('posts', 'tags'));
    }

    // Store new post
    public function store(PostRequest $request)
    {
        // Validate incoming data using PostRequest
        $validated = $request->validated();

        // Get the authenticated user
        $user = auth()->user();

        // If no user is authenticated, return an error
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        // Ensure content is decoded if it was URL-encoded
        $content = urldecode($validated['content']);

        // Create the new post
        $post = Post::create([
            'title' => $validated['title'],
            'content' => $content,
            'user_id' => $user->id,
        ]);

        // Attach tags to the post (if provided)
        if ($request->has('tags')) {
            $post->tags()->attach($validated['tags']);
        }

        // Send a notification to the user
        Notification::send($user, new PostCreated());

        // Return a success message
        return response()->json(['message' => 'Post created successfully!', 'post' => $post], 201);
    }

    // Show a specific post
    public function show($id)
    {
        // Find the post by ID with its tags
        $post = Post::with('tags')->findOrFail($id);

        // Return the post as JSON (for API)
        return response()->json($post);
    }

    // Update a post and its tags
    public function update(PostRequest $request, $id)
    {
        // Validate incoming data using PostRequest
        $validated = $request->validated();

        // Find the post
        $post = Post::findOrFail($id);

        // Update the post
        $post->update([
            'title' => $validated['title'],
            'content' => urldecode($validated['content']), // Decode content if needed
        ]);

        // Sync the tags (detach existing and attach new)
        if ($request->has('tags')) {
            $post->tags()->sync($validated['tags']);
        }

        // Return a success message
        return response()->json(['message' => 'Post updated successfully!', 'post' => $post], 200);
    }

    // Filter posts by a specific tag
    public function filterByTag($tagId)
    {
        // Retrieve posts associated with a specific tag
        $posts = Post::whereHas('tags', function ($query) use ($tagId) {
            $query->where('id', $tagId);
        })->with('tags')->get();

        return response()->json($posts);
    }

    // Test notification (can be called directly)
    public function sendTestNotification()
    {
        $user = auth()->user(); // or get the first user
        Notification::send($user, new PostCreated());

        return response()->json(['message' => 'Test notification sent!']);
    }
}
