<!DOCTYPE html>
<html lang="id">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Rekap Transaksi</title>
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>

</head> 

<body>
    <div class="container mt-3">
        <h2>Transactions</h2>
        <div class="no-print">
            <a href="{{ url('transactions/create') }}"><button type="button" class="btn btn-success btn-sm">Tambah</button></a>
            <a href="{{ url('transactions') }}" class="btn btn-primary btn-sm me-1">Rekap</a>
            <a href="{{ url('transactions/detail') }}" class="btn btn-warning btn-sm me-1">Rekap Detail</a>
        </div>
        <table class="table table-striped">
        <thead>
            <tr>
                <th>Aksi</th>
                <th>ID</th>
                <th>Kode</th>
                <th>Tanggal</th>
                <th class="text-end">Total</th>
            </tr>
        </thead>
        <tbody id="TransactionTableBody">
            @foreach($transactions as $transaction)
            <tr>
                <td>
                    <a href="{{ url('transactions/show', $transaction->id) }}" class="btn btn-warning btnsm">View</a>
                </td>
                <td>{{$transaction->id}}</td>
                <td>{{$transaction->invoice_number}}</td>
                <td>{{ date('d-m-Y', strtotime($transaction->transaction_date)) }}</td>
                <td class="text-end">Rp {{number_format($transaction->total_amount, 2,',','.')}}</td> 
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</body>
</html>
