<!DOCTYPE html>
<html>
<head>
    <title>Segitiga</title>
</head>
<body>
    <h2>Perhitungan Segitiga</h2>

    <form action="/laravelpr/latihan003/hitungSegitiga" method="POST">
        @csrf
        <label for="alas">Panjang Alas:</label>
        <input type="number" name="alas" placeholder="Panjang Alas" required>
        <label for="tinggi">Panjang Tinggi:</label>
        <input type="number" name="tinggi" placeholder="Panjang Tinggi" required> <br> <br>
        <label for="sisi1">Panjang Sisi 1:</label>
        <input type="number" name="sisi1" placeholder="Panjang Sisi 1" required>
        <label for="sisi2">Panjang Sisi 2:</label>
        <input type="number" name="sisi2" placeholder="Panjang Sisi 2" required>
        <label for="sisi3">Panjang Sisi 3:</label>
        <input type="number" name="sisi3" placeholder="Panjang Sisi 3" required>
        <button type="submit">Hitung</button>
    </form>

    
</body>
</html>