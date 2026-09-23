<!DOCTYPE html>
<html>
<head>
    <title>Persegi</title>
</head>
<body>
    <h2>Perhitungan Persegi</h2>

    <form action="/laravelpr/latihan003/hitungPersegi" method="POST">
        @csrf
        <label for="sisi">Panjang Sisi:</label>
        <input type="number" name="sisi" min="1" placeholder="Panjang Sisi" required>
        <button type="submit">Hitung</button>
    </form>

    
</body>
</html>