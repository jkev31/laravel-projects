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
    
}
