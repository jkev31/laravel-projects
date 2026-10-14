<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    @if (session('status'))
        <p style="color: green;">{{ session('status') }}</p>
    @endif

    <h3>Role Kamu: {{ $role }}</h3>
</body>
</html>