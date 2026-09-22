<!DOCTYPE html>
<html>

<head>
    <title>Form Karyawan</title>
</head>

<body>
    <h1>Form Karyawan</h1>
    <form action="insertkaryawan" method="post">
    @csrf
    <input type="text" name="kode" placeholder="Kode"> <br>
    <input type="text" name="nama" placeholder="Nama"> <br>
    <input type="text" name="umur" placeholder="Umur"> <br>
    <button type="submit">Save</button>
    
    
    </form>
</body>
</html>