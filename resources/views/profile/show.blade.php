<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }}'s Profile</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>{{ $user->name }}'s Profile</h1>

        <p><strong>Email:</strong> {{ $user->email }}</p>

        <h3>Profile Information:</h3>
        <p><strong>Bio:</strong> {{ $profile->bio ? $profile->bio : 'No bio provided.' }}</p>
        <p><strong>Avatar:</strong> 
            @if ($profile->avatar)
                <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar" width="100">
            @else
                <span>No avatar set.</span>
            @endif
        </p>

        <div>
            <h3>Update Profile</h3>
            <!-- You can add a form here to allow users to update their profile (bio, avatar, etc.) -->
        </div>

        <form action="{{ route('logout') }}" method="POST" style="text-align: right;">
            @csrf
            <button type="submit">Sign Out</button>
        </form>
    </div>
</body>
</html>
