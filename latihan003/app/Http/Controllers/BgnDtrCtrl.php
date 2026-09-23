<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class BgnDtrCtrl extends Controller
{
    public function index() {
       return view('BgnDtr');
    } 
    
    public function hitungLuasPersegi(Request $request) {
        $sisi = $request->sisi;
        $luas = $sisi * $sisi;
        $keliling = 4 * $sisi;
        return "luas persegi: " . $luas . " dan keliling persegi: " . $keliling;
    }

    public function hitungLuasLingkaran(Request $request) {
        $radius = $request->radius;
        $luas = 3.14 * $radius * $radius;
        $keliling = 2 * 3.14 * $radius;
        return "luas lingkaran: " . $luas . " dan keliling lingkaran: " . $keliling;
    }
    
}
