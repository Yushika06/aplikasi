<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <form method="POST" action="{{ url('/register') }}">
        @csrf
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" value="{{ old('username') }}">
            @error('username')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password">
            @error('password')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" name="password_confirmation">
        </div>
        <div>
            <button type="submit">Register</button>
        </div>
    </form>
</body>
</html>
