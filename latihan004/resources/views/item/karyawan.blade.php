@extends('layouts.main')

@section('title', 'Daftar Karyawan')

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
    <h2>Daftar Karyawan: {{ $divisi }}</h2>
    <x-alert type="warning">
        <strong>Perhatian!</strong> Data karyawan yang bekerja di divisi {{ $divisi }}.
    </x-alert>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Status Kehadiran</th>
            </tr>
        </thead>
        <tbody>
        @forelse($karyawan as $k)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $k['nama'] }}</td>
                <td>{{ $k['jabatan'] }}</td>
                <td>
                    <span class="{{ $k['hadir'] ? 'badge-success' : 'badge-danger' }}">
                        {{ $k['hadir'] ? 'Hadir' : 'Tidak Hadir' }}
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align: center;">
                    Tidak ada data item dalam katalog ini.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div style="margin-top: 20px;">
        <p><strong>Total Karyawan:</strong> {{ count($karyawan) }}</p>
    </div>
@endsection