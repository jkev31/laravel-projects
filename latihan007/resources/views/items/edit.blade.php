<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Item</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</head>
<body>

<div class="container mt-4">
  <h2>Edit Item</h2>

  @foreach ($item as $x)
      <input type="hidden" id="id1" value="{{ $x->id }}">

      <div class="mt-3">
          <input type="text" class="form-control" id="name1" placeholder="Masukan Nama" name="nama" value="{{ $x->name }}">
      </div>
      <div class="mt-3">
          <input type="text" class="form-control" id="desc1" placeholder="Masukan Deskripsi" name="desc" value="{{ $x->description }}">
      </div>
      <div class="mt-3">
          <input type="number" class="form-control" id="price1" placeholder="Masukan Harga" name="price" min="0" value="{{ $x->price }}">
      </div>
      <div class="mt-3">
          <input type="number" class="form-control" id="stock1" placeholder="Masukan Stok" name="stock" min="1" value="{{ $x->stock }}">
      </div>
      <div class="mt-3">
          <input type="date" class="form-control" id="tgl1" placeholder="Masukan Tanggal Terima" name="tgl_terima" value="{{ $x->tgl_terima }}">
      </div>
  @endforeach

  <div class="mt-3">
      <a href="{{ url('items') }}" class="btn btn-secondary">Kembali</a>
      <button type="button" class="btn btn-success" id="save1">Save changes</button>
      <button type="button" class="btn btn-danger" id="delete">Delete</button>
  </div>
</div>

<script>
// Update Data
$('#save1').on("click", function() {
    let id = $("#id1").val();
    if (!id) {
        alert("ID item tidak ditemukan!");
        return;
    }

    var formdata = new FormData();
    formdata.append('id', id);
    formdata.append('name', $("#name1").val());
    formdata.append('description', $("#desc1").val());
    formdata.append('price', $("#price1").val());
    formdata.append('stock', $("#stock1").val());
    formdata.append('tgl_terima', $("#tgl1").val());
    formdata.append('_method', 'PUT');
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    formdata.append('_token', csrfToken);

    $.ajax({
        type: 'POST',
        url: "{{ url('items') }}",
        data: formdata,
        processData: false,
        contentType: false,
        success: function(response) {
            alert(response.message || 'Data berhasil diupdate!');
            window.location.href = "{{ url('items') }}";
        },
        error: function(xhr) {
            console.error('Error:', xhr.responseJSON);
            alert('Gagal mengupdate data!');
        }
    });
});

// Hapus Data
$('#delete').on("click", function() {
    let id = $("#id1").val();
    if (!id) {
        alert("ID item tidak ditemukan!");
        return;
    }

    if (!confirm('Apakah Anda yakin ingin menghapus item ini?')) {
        return;
    }

    var formdata = new FormData();
    formdata.append('id', id);
    formdata.append('_method', 'DELETE');
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    formdata.append('_token', csrfToken);

    $.ajax({
        type: 'POST',
        url: "{{ url('items') }}",
        data: formdata,
        processData: false,
        contentType: false,
        success: function(response) {
            alert(response.message || 'Data berhasil dihapus!');
            window.location.href = "{{ url('items') }}";
        },
        error: function(xhr) {
            console.error('Error:', xhr.responseJSON);
            alert('Gagal menghapus data!');
        }
    });
});
</script>
</body>
</html>