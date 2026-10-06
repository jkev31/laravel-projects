<!DOCTYPE html>
<html lang="en">
<head>
  <title>Item</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token Meta untuk AJAX -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-4">
  <h2>Daftar Item</h2>
  <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambah" id="add">Tambah Item</button>
  <table class="table table-bordered table-hover table-striped" id="myTable">
    <thead>
        <tr>
            <th style="width: 100px;">Action</th>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Stock</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($item as $x)
            <tr>
                <td>
                    <!-- Menggunakan Class .btn-edit dan data-attributes untuk menyimpan baris data -->
                    <button class="btn btn-primary btn-edit" 
                            data-bs-toggle="modal" 
                            data-bs-target="#modaledit"
                            data-id="{{ $x->id }}"
                            data-name="{{ $x->name }}"
                            data-description="{{ $x->description }}"
                            data-price="{{ $x->price }}"
                            data-stock="{{ $x->stock }}">
                        Edit
                    </button>
                </td>
                <td>{{ $x->id }}</td>
                <td>{{ $x->name }}</td>
                <td>{{ $x->description }}</td>
                <td>{{ $x->price }}</td>
                <td>{{ $x->stock }}</td>
            </tr>
        @endforeach
    </tbody>
  </table>
</div>

<!-- Modal Tambah Item -->
<div class="modal fade" id="tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modaltambah">Tambah Item</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="save">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Item -->
<div class="modal fade" id="modaledit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Edit Item</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Hidden input ID item -->
        <input type="hidden" id="id1">

        <div class="mt-3">
            <input type="text" class="form-control" id="name1" placeholder="Masukan Nama" name="nama">
        </div>
        <div class="mt-3">
            <input type="text" class="form-control" id="desc1" placeholder="Masukan Deskripsi" name="desc">
        </div>
        <div class="mt-3">
            <input type="number" class="form-control" id="price1" placeholder="Masukan Harga" name="price" min="0">
        </div>
        <div class="mt-3">
            <input type="number" class="form-control" id="stock1" placeholder="Masukan Stok" name="stock" min="1">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="save1">Save changes</button>
        <button type="button" class="btn btn-danger" id="delete">Delete</button>
      </div>
    </div>
  </div>
</div>

<script>

$(document).on('click', '.btn-edit', function() {
    let id = $(this).data('id');
    let name = $(this).data('name');
    let desc = $(this).data('description');
    let price = $(this).data('price');
    let stock = $(this).data('stock');

    $('#id1').val(id);
    $('#name1').val(name);
    $('#desc1').val(desc);
    $('#price1').val(price);
    $('#stock1').val(stock);
});


$('#save').on("click", function() {
    var formdata = new FormData();
    formdata.append('name', $('#name').val());
    formdata.append('description', $('#desc').val());
    formdata.append('price', $('#price').val());
    formdata.append('stock', $('#stock').val());

    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    formdata.append('_token', csrfToken); 

    $.ajax({
        type: 'POST',
        url: 'items',
        data: formdata,
        processData: false,
        contentType: false,
        success: function (response) {
            alert(response.message || 'Data berhasil disimpan!');
            location.reload();
        },
        error: function (xhr) {
            console.error('Error:', xhr.responseJSON);
            alert('Gagal menambah item!');
        }
    });
});

// 3. Update Data (PUT /items/{id})
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
    formdata.append('_method', 'PUT'); // Method spoofing Laravel untuk UPDATE

    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    formdata.append('_token', csrfToken); 

    $.ajax({
        type: 'POST',
        url: 'items',
        data: formdata,
        processData: false,
        contentType: false,
        success: function(response) {
            alert(response.message || 'Data berhasil diupdate!');
            location.reload();
        },
        error: function(xhr) {
            console.error('Error:', xhr.responseJSON);
            alert('Gagal mengupdate data!');
        }
    });
});

// 4. Hapus Data (DELETE /items/{id})
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
    formdata.append('_method', 'DELETE'); // Method spoofing Laravel untuk DELETE

    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    formdata.append('_token', csrfToken); 

    $.ajax({
        type: 'POST',
        url: 'items',
        data: formdata,
        processData: false,
        contentType: false,
        success: function(response) {
            alert(response.message || 'Data berhasil dihapus!');
            location.reload();
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