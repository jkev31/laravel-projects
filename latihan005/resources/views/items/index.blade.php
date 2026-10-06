<!DOCTYPE html>
<html lang="en">
<head>
  <title>Item</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Daftar Item</h2>
  <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambah" id="add">tambah item</button>
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
                <td><button class="btn btn-primary btn-edit" id="edit" data-bs-toggle="modal" data-bs-target="#modaledit">Edit</button></td>
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

<!-- The Modal Tambah Item -->
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
            
            <input type="number" class="form-control" id="price" placeholder="Masukan Harga" name="price">
        </div>
        <div class="mt-3">
            
            <input type="number" class="form-control" id="stock" placeholder="Masukan Stok" name="stock">
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="save">Save changes</button>
      </div>
    </div>
  </div>
</div>



<!-- The Modal Edit Item -->
<div class="modal fade" id="modaledit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title">Edit Item</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mt-3">
            <input type="text" class="form-control" id="name1" placeholder="Masukan Nama" name="nama">
        </div>
        <div class="mt-3">
            
            <input type="text" class="form-control" id="desc1" placeholder="Masukan Deskripsi" name="desc">
        </div>
        <div class="mt-3">
            
            <input type="number" class="form-control" id="price1" placeholder="Masukan Harga" name="price">
        </div>
        <div class="mt-3">
            
            <input type="number" class="form-control" id="stock1" placeholder="Masukan Stok" name="stock">
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="save1">Save changes</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="delete">Delete</button>
      </div>
    </div>
  </div>
</div>

<script>

$('#save').on("click", function() {
    var formdata = new FormData();
    let name = $('#name').val();
    let desc = $('#desc').val();
    let price = $('#price').val();
    let stock = $('#stock').val();


    formdata.append('name',name);
    formdata.append('desc',desc);
    formdata.append('price',price);
    formdata.append('stock',stock);
    console.log(name);
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    formdata.append('_token',csrfToken); 

    
    $.ajax({
        type: 'POST',
        url: 'items', // URL tujuan backend Anda
        data: formdata,
        processData: false,  // Wajib: cegah jQuery memproses data menjadi string
        contentType: false,  // Wajib: biarkan browser menentukan header multipart/form-data
        success: function (response) {
            console.log('Sukses:', response);
            alert('Data berhasil dikirim!');
            location.reload();
        },
        error: function (xhr, status, error) {
            console.error('Gagal:', error);
        }
    });
})

$('#edit').on("click",function (){
    var formdata = new FormData();
    formdata.append('id',$("#id1").val());
    formdata.append('name',$("#name1").val());
    formdata.append('description',$("#desc1").val());
    formdata.append('price',$("#price1").val());
    formdata.append('stock',$("#stock1").val());

    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    formdata.append('_token',csrfToken); 

     $.ajax({
        type: 'GET',
        url: 'items',
        data: formdata, // Mengambil semua data form
        processData:false,
        contentType:false,
        success: function(response) {
            console.log('Sukses:', response);
            alert('Data berhasil diupdate!');
            location.reload();
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
})



$('#delete').on("click",function(){
    var formdata = new FormData();
    formdata.append('id',$("#id1").val());

    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    formdata.append('_token',csrfToken); 

     $.ajax({
        type: 'DELETE',
        url: 'items',
        data: formdata, // Mengambil semua data form
        processData:false,
        contentType:false,
        success: function(response) {
            console.log('Sukses:', response);
            alert('Data berhasil dihapus!');
            location.reload();
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
})



</script>
</body>
</html>