<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form method="POST" action="{{ url('/login') }}">
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
            <button type="submit">Login</button>
        </div>
    </form>
</body>
</html>
