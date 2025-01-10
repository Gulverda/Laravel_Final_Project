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

        @foreach ($posts as $post)
            <div class="post">
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->content }}</p>
                <p><strong>By: </strong>{{ $post->user->name }}</p>
            </div>
        @endforeach

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div>
                <label for="title">Title</label>
                <input type="text" name="title" id="title" required>
            </div>
            <div>
                <label for="content">Content</label>
                <textarea name="content" id="content" required></textarea>
            </div>
            <div>
                <button type="submit">Create Post</button>
            </div>
        </form>
    </div>
</body>
</html>