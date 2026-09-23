    <! DOCTYPE html>
    <html>

    <head>
    <title>Calculator Laravel</title>
    </head>

    <body>
    <h1>Calculator Sederhana</h1>
    <form action="calculator/add" method="POST">
    @csrf

    <input type="number" name="number1" placeholder="Angka 1" required>
    <input type="number" name="number2" placeholder="Angka 2" required>
    <button type="submit">Tambah</button>
    </form>

    <form action="calculator/substract" method="POST">
    @csrf

    <input type="number" name="number1" placeholder="Angka 1" required>
    <input type="number" name="number2" placeholder="Angka 2" required>
    <button type="submit">Kurang</button>
    </form>

    <form action="calculator/multiply" method="POST">
    @csrf

    <input type="number" name="number1" placeholder="Angka 1" required>
    <input type="number" name="number2" placeholder="Angka 2" required>
    <button type="submit">Kali</button>
    </form>

    <form action="calculator/divide" method="POST">
    @csrf

    <input type="number" name="number1" placeholder="Angka 1" required>
    <input type="number" name="number2" placeholder="Angka 2" required>
    <button type="submit">Bagi</button>
    </form>

    </body>
    </html>