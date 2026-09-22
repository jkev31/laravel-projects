<!DOCTYPE html>
<html>

<head>
<title>Form Pembelian</title>
</head>

<body>
<h1>Form Pembelian</h1>
<form action="{{ url('Pembelian/hitungDiskon') }}" method="POST">
@csrf

<label for="nama">Nama Barang</label> <br>
<input type="text" name="nama" placeholder="Nama Barang" required> <br>

<label for="harga">Harga Barang</label> <br>
<input type="number" name="harga" placeholder="Harga Barang" required> <br>

<label for="diskon">Diskon %</label> <br>
<input type="number" name="diskon" placeholder="Diskon %" required> <br>

<button type="submit">Hitung Total</button>
</form>

</body>
</html>