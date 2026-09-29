@extends('layouts.main')

@section('title', 'Daftar Supplier')

<form action="/laravelpr/latihan004/katalog" method="POST">
    @csrf
    <button type="submit">Item</button>
</form>
<form action="/laravelpr/latihan004/karyawan" method="POST">
    @csrf
    <button type="submit">Karyawan</button>
</form>
<form action="/laravelpr/latihan004/supplier" method="POST">
    @csrf
    <button type="submit">Supplier</button>
</form>

@section('content')
    <h2>Daftar Supplier</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Supplier</th>
                <th>Lokasi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @forelse($supplier as $s)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $s['nama'] }}</td>
                <td>{{ $s['lokasi'] }}</td>
                
                <td>
                    <span class="{{ $s['is_active'] ? 'badge-success' : 'badge-secondary' }}">
                        {{ $s['is_active'] ? 'Aktif' : 'Non-Aktif' }}
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align: center;">
                    Tidak ada data supplier.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div style="margin-top: 20px;">
        <p><strong>Total Supplier:</strong> {{ count($supplier) }}</p>
    </div>
@endsection