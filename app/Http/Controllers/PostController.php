<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Notifications\PostCreated;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\PostRequest; 

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('tags', 'user')->get();

        $tags = Tag::all();

        return view('posts.index', compact('posts', 'tags'));
    }

    public function store(PostRequest $request)
    {
        try {
            $validated = $request->validated();
    
            $user = auth()->user();
            if (!$user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }
    
            $post = Post::create([
                'title' => $validated['title'],
                'content' => urldecode($validated['content']),
                'user_id' => $user->id,
            ]);
    
            return response()->json(['message' => 'Post created successfully!', 'post' => $post], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    

    public function show($id)
    {
        $post = Post::with('tags')->findOrFail($id);

        return response()->json($post);
    }

    public function update(PostRequest $request, $id)
    {
        $validated = $request->validated();

        $post = Post::findOrFail($id);

        $post->update([
            'title' => $validated['title'],
            'content' => urldecode($validated['content']), // Decode content if needed
        ]);

        if ($request->has('tags')) {
            $post->tags()->sync($validated['tags']);
        }

        return response()->json(['message' => 'Post updated successfully!', 'post' => $post], 200);
    }

    public function filterByTag($tagId)
    {
        $posts = Post::whereHas('tags', function ($query) use ($tagId) {
            $query->where('id', $tagId);
        })->with('tags')->get();

        return response()->json($posts);
    }

    public function sendTestNotification()
    {
        $user = auth()->user(); 
        Notification::send($user, new PostCreated());

        return response()->json(['message' => 'Test notification sent!']);
    }
}
