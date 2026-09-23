<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
</head>
<body>
    <h2>Pilih Bangun Datar</h2>

    <form action="/laravelpr/latihan003/pilihMenu" method="POST">
        @csrf
        <select name="pilihan">
            <option value="persegi">Persegi</option>
            <option value="segitiga">Segitiga</option>
            <option value="lingkaran">Lingkaran</option>
        </select>
        <button type="submit">Pilih</button>
    </form>

</body>
</html>