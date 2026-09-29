<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Toko Kita</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background-color: #f4f6f9; }
        .container { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px
        rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #dee2e6; padding: 10px; text-align: left; }
        th { background-color: #343a40; color: white; }
        .text-danger { color: #dc3545; font-weight: bold; }
        .badge-success { background: #198754; color: white; padding: 3px 8px; border-radius: 3px; }
        .badge-secondary { background: #6c757d; color: white; padding: 3px 8px; border-radius:
        3px; }
    </style>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>