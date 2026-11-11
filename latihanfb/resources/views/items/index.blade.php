<!DOCTYPE html>
<html lang="en">
<head>
  <title>Item</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</head>
<body>

<div class="container mt-4">
  <h2>Daftar Item</h2>

  <a href="{{ url('items/create') }}" class="btn btn-primary mb-3">Tambah Item</a>

  <table class="table table-bordered table-hover table-striped" id="myTable">
    <thead>
        <tr>
            <th style="width: 100px;">Action</th>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($item as $x)
            <tr>
                <td>
                    <a href="{{ url('items/edit/' . $x->id) }}" class="btn btn-primary">Edit</a>
                </td>
                <td>{{ $x->id }}</td>
                <td>{{ $x->name }}</td>
                <td>{{ $x->description }}</td>
                <td>{{ $x->price }}</td>
                <td>{{ $x->stock }}</td>
                <td>{{ date('d-m-Y', strtotime($x->tgl_terima)) }}</td>
            </tr>
        @endforeach
    </tbody>
  </table>
</div>

</body>
</html>