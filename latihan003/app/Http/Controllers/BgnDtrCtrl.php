<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class BgnDtrCtrl extends Controller
{
    public function index() {
       return view('BangunDatar.menu');
    }

    public function inputData(Request $request) {
    $pilihan = $request->pilihan;

    switch ($pilihan) {
        case 'persegi':
            return view('BangunDatar.persegi');
        case 'segitiga':
            return view('BangunDatar.segitiga');
        case 'lingkaran':
            return view('BangunDatar.lingkaran');
    }}

    public function hitungPersegi(Request $request) {
        $sisi = $request->sisi;
        $luas = $sisi * $sisi;
        $keliling = 4 * $sisi;
        return "luas persegi: " . $luas . " dan keliling persegi: " . $keliling;
    }

    public function hitungSegitiga(Request $request) {
        $alas = $request->alas;
        $tinggi = $request->tinggi;
        $sisi1 = $request->sisi1;
        $sisi2 = $request->sisi2;
        $sisi3 = $request->sisi3;
        $luas = 0.5 * $alas * $tinggi;
        $keliling = $sisi1 + $sisi2 + $sisi3;
        return "luas segitiga: " . $luas . " dan keliling segitiga: " . $keliling;
    }

    public function hitungLingkaran(Request $request) {
        $radius = $request->radius;
        $luas = 3.14 * $radius * $radius;
        $keliling = 2 * 3.14 * $radius;
        return "luas lingkaran: " . $luas . " dan keliling lingkaran: " . $keliling;
    }
    
}
