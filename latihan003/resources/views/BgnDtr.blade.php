<!DOCTYPE html>
<html>
<head>
    <title>Bangun Datar</title>
</head>
<body>
    <h2>Perhitungan Bangun Datar: Persegi</h2>

    <form action="BgnDtr/hitungLuasPersegi" method="POST">
        @csrf
        <label for="sisi">Panjang Sisi:</label>
        <input type="number" name="sisi" placeholder="Panjang Sisi" required>
        <button type="submit">Hitung</button>
    </form>

    
</body>
</html>