<!DOCTYPE html>
<html>
<head>
    <title>Bangun Ruang</title>
</head>
<body>
    <h2>Perhitungan Bangun Ruang: Kubus</h2>

    <form action="{{ url('/BgnRng/hitungVolumeKubus') }}" method="POST">
        @csrf
        <label for="sisi">Panjang Sisi Kubus:</label>
        <input type="number" name="sisi" placeholder="Panjang Sisi Kubus" required>
        <button type="submit">Hitung</button>
    </form>

    
</body>
</html>