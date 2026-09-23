<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PembelianCtrl extends Controller
{
    public function index() {
        return view('Pembelian');
    }
    
    public function hitungDiskon(Request $request) {
        $harga = $request->harga;
        $diskon = $request->diskon;
        $potongan = $harga * ($diskon / 100);
        $total = $harga - $potongan;
        return "nama barang: " . $request->nama . ", diskon: " . $request->diskon . " dan total harga: " . $total;
    }
}
