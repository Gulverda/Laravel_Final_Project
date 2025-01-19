<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>All Posts</h1>

        <!-- Check if user is logged in -->
        @auth
            <div style="text-align: right;">
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">Sign Out</button>
                </form>
                <a href="{{ route('profile.show', auth()->user()->id) }}" style="margin-left: 10px;">Profile</a>
            </div>
        @else
            <div style="text-align: right;">
                <a href="{{ route('login') }}">Login</a>
            </div>
        @endauth

        <!-- Display all posts -->
        @foreach ($posts as $post)
        <div class="post">
            <h2>{{ $post->title }}</h2>
            <!-- Display content as raw HTML using {!! $post->content !!} -->
            <p>{!! $post->content !!}</p>
            <p><strong>By:</strong> {{ $post->user->name }}</p>

            <!-- Show Tags -->
            @if ($post->tags->isNotEmpty())
                <p><strong>Tags:</strong>
                    @foreach ($post->tags as $tag)
                        <span style="background-color: #f0f0f0; padding: 2px 6px; border-radius: 4px;">{{ $tag->name }}</span>
                    @endforeach
                </p>
            @else
                <p><em>No tags</em></p>
            @endif
        </div>
        @endforeach

        <!-- Display success message if post was created -->
        @if(session('message'))
            <p style="color: green;">{{ session('message') }}</p>
        @endif

        <!-- Post creation form (visible only to logged-in users) -->
        @auth
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                <div>
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}">
                    @error('title')
                        <div style="color: red; font-weight: bold;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="content">Content</label>
                    <textarea name="content" id="content">{{ old('content') }}</textarea>
                    @error('content')
                        <div style="color: red; font-weight: bold;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="tags">Tags</label>
                    <select name="tags[]" id="tags" multiple>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                    @error('tags')
                        <div style="color: red; font-weight: bold;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <button type="submit">Create Post</button>
                </div>
            </form>
        @else
            <p>Please <a href="{{ route('login') }}">login</a> to create a post.</p>
        @endauth
    </div>
</body>
</html>
