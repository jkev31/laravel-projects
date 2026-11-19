<!DOCTYPE html>
<html lang="en">
<head>
  <title>Tambah Item</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</head>
<body>

<div class="container mt-4">
  <h2>Tambah Item</h2>

  <div class="mt-3">
      <input type="text" class="form-control" id="name" placeholder="Masukan Nama" name="nama">
  </div>
  <div class="mt-3">
      <input type="text" class="form-control" id="desc" placeholder="Masukan Deskripsi" name="desc">
  </div>
  <div class="mt-3">
      <input type="number" class="form-control" id="price" placeholder="Masukan Harga" name="price" min="0">
  </div>
  <div class="mt-3">
      <input type="number" class="form-control" id="stock" placeholder="Masukan Stok" name="stock" min="1">
  </div>
  <div class="mt-3">
      <input type="date" class="form-control" id="tgl_terima" placeholder="Masukan Tanggal Terima" name="tgl_terima">
  </div>

  <div class="mt-3">
      <a href="{{ url('items') }}" class="btn btn-secondary">Kembali</a>
      <button type="button" class="btn btn-success" id="save">Save changes</button>
  </div>
</div>

<script>
$('#save').on("click", function() {
    var formdata = new FormData();
    formdata.append('name', $('#name').val());
    formdata.append('description', $('#desc').val());
    formdata.append('price', $('#price').val());
    formdata.append('stock', $('#stock').val());
    formdata.append('tgl_terima', $('#tgl_terima').val());


    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    formdata.append('_token', csrfToken);

    $.ajax({
        type: 'POST',
        url: "{{ url('items') }}",
        data: formdata,
        processData: false,
        contentType: false,
        success: function (response) {
            alert(response.message || 'Data berhasil disimpan!');
            window.location.href = "{{ url('items') }}";
        },
        error: function (xhr) {
            console.error('Error:', xhr.responseJSON);
            alert('Gagal menambah item!');
        }
    });
});
</script>
</body>
</html>