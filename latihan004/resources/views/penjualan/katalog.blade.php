@extends('layouts.main')

@section('title', 'Katalog Item Penjualan')


@section('content')
    <h2>Katalog Item</h2>
    <x-alert type="warning">
        <strong>Perhatian!</strong> Harap periksa ketersediaan stok sebelum memproses
        pesanan.
    </x-alert>
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Item</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Diskon Persen <span> % </span></th>
                <th>Harga Bersih</th>
            </tr>
        </thead>
        <tbody>
        @forelse($items as $item)
            <tr style="
                @if ($item['diskon_persen'] >= 20)
                    background-color: #c79191ff;
                @else
                    background-color: #ffffffff;
                @endif
            ">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item['nama_item'] }}</td>
                <td>{{ $item['kategori'] }}</td>
                <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                <td>{{ $item['diskon_persen'] }} %</td>
                <td>
                    Rp {{ number_format($item['harga'] - ($item['harga'] * ($item['diskon_persen'] / 100)), 0, ',', '.') }}
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
        <p><strong>Total Jenis Item:</strong> {{ count($items) }}</p>
    </div>
@endsection