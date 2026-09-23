<!DOCTYPE html>
<html>
<head>
    <title>Lingkaran</title>
</head>
<body>
    <h2>Perhitungan Lingkaran</h2>

    <form action="/laravelpr/latihan003/hitungLingkaran" method="POST">
        @csrf
        <label for="radius">Panjang Jari-Jari:</label>
        <input type="number" name="radius" placeholder="Panjang Jari-Jari" required>
        <button type="submit">Hitung</button>
    </form>

    
</body>
</html>