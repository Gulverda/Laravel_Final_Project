<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div class="container">
        <h1>Register</h1>

        <!-- Error message for registration -->
        @if(session('error'))
            <div class="error" style="color: red; font-size: 0.9em;">{{ session('error') }}</div>
        @endif

        <!-- Registration Form -->
        <form action="{{ route('register.submit') }}" method="POST">
            @csrf
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}">
                <!-- Validation error for name -->
                @error('name')
                    <div style="color: red; font-size: 0.9em; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>
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
                <input type="password" name="password" id="password">
                <!-- Validation error for password -->
                @error('password')
                    <div style="color: red; font-size: 0.9em; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
                <!-- Validation error for password_confirmation -->
                @error('password_confirmation')
                    <div style="color: red; font-size: 0.9em; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <button type="submit">Register</button>
            </div>
        </form>

        <a href="{{ route('login') }}">Already have an account? Login here.</a>
    </div>
</body>
</html>
