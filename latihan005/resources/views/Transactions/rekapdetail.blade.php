<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Detail Transaksi</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
</head>

<body class="bg-light">
    <div class="container py-4">
        <h2 class="mb-3">Rekap Detail</h2>
        
        <!-- Tombol Navigasi -->
        <div class="mb-3">
            <a href="{{ url('transactions/create') }}" class="btn btn-success btn-sm me-1">Tambah</a>
            <a href="{{ url('transactions') }}" class="btn btn-primary btn-sm me-1">Rekap</a>
            <a href="{{ url('transactions/detail') }}" class="btn btn-warning btn-sm me-1">Rekap Detail</a>
        </div>

        <!-- Tabel Rekap Detail -->
        <div class="table-responsive bg-white p-3 rounded shadow-sm">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>No. Invoice</th>
                        <th>Tanggal Transaksi</th>
                        <th>Kode Item</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp
                    @forelse($details as $detail)
                        @php $grandTotal += $detail->subtotal; @endphp
                        <tr>
                            <td>{{ $detail->invoice_number }}</td>
                            <td>{{ date('Y-m-d', strtotime($detail->transaction_date)) }}</td>
                            <td>{{ $detail->item_id }}</td>
                            <td>{{ $detail->name }}</td>
                            <td>{{ $detail->description ?? '-' }}</td>
                            <td>{{ number_format($detail->price, 2, '.', '') }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ number_format($detail->subtotal, 2, '.', '') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Belum ada data detail transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7" class="text-end fw-bold">Grand Total:</td>
                        <td class="fw-bold text-primary">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>

</html>