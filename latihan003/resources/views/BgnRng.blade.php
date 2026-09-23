<!DOCTYPE html>
<html>
<head>
    <title>Bangun Ruang</title>
</head>
<body>
    <h2>Perhitungan Bangun Ruang: Kubus</h2>

    <form action="BgnRng/hitungVolumeKubus" method="POST">
        @csrf
        <label for="sisi">Panjang Sisi Kubus:</label>
        <input type="number" name="sisi" placeholder="Panjang Sisi Kubus" required> <br>
        <button type="submit">Hitung</button>
    </form>

    <h2>Perhitungan Bangun Ruang: Balok</h2>

    <form action="{{ url('/BgnRng/hitungVolumeBalok') }}" method="POST">
        @csrf
        <label for="panjang">Panjang Balok:</label>
        <input type="number" name="panjang" placeholder="Panjang Balok" required> <br> <br>
        <label for="panjang">Lebar Balok:</label>
        <input type="number" name="lebar" placeholder="Lebar Balok" required> <br> <br>
        <label for="panjang">Tinggi Balok:</label>
        <input type="number" name="tinggi" placeholder="Tinggi Balok" required> <br> <br>
        <button type="submit">Hitung</button>
    </form>

    <h2>Perhitungan Bangun Ruang: Tabung</h2>

    <form action="{{ url('/BgnRng/hitungVolumeTabung') }}" method="POST">
        @csrf
        <label for="radius">Radius:</label>
        <input type="number" name="radius" placeholder="Radius" required>
        <label for="tinggi">Tinggi tabung:</label>
        <input type="number" name="tinggi" placeholder="Tinggi Tabung" required> <br>
        <button type="submit">Hitung</button>
    </form>

    
</body>
</html>