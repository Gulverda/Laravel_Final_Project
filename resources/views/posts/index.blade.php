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
            <form action="{{ route('logout') }}" method="POST" style="text-align: right;">
                @csrf
                <button type="submit">Sign Out</button>
            </form>
        @else
            <div style="text-align: right;">
                <a href="{{ route('login') }}">Login</a>
            </div>
        @endauth

        <!-- Display all posts -->
        @foreach ($posts as $post)
            <div class="post">
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->content }}</p>
                <p><strong>By: </strong>{{ $post->user->name }}</p>
            </div>
        @endforeach

        <!-- Post creation form (visible only to logged-in users) -->
        @auth
        <form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="{{ old('title') }}" required>
        @error('title')
            <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="content">Content</label>
        <textarea name="content" id="content" required>{{ old('content') }}</textarea>
        @error('content')
            <div style="color: red;">{{ $message }}</div>
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
