<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body>
    <div class="container">
        <form method="get" action="{{ route('login') }}">
            <h1>Login</h1>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="admin@admin.com" required>
            <label for="password">Password:</label>
            <input type="password" id="password" value="12345" name=" password" required>
            <button type="submit" onclick="LoginAdminF()">Login</button>
        </form>
    </div>
</body>

</html>