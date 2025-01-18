<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div class="container">
        <h1>Login</h1>

        <!-- Error message for incorrect login -->
        @if(session('error'))
            <div class="error" style="color: red; font-size: 0.9em;">{{ session('error') }}</div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}">
                <!-- Validation error for email -->
                @error('email')
                    <div style="color: red; font-size: 0.9em; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" >
                <!-- Validation error for password -->
                @error('password')
                    <div style="color: red; font-size: 0.9em; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <button type="submit">Login</button>
            </div>
        </form>

        <a href="{{ route('register') }}">Don't have an account? Register here.</a>
    </div>
</body>
</html>
