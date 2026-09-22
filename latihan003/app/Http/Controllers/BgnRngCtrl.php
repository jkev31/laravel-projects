<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class BgnRngCtrl extends Controller
{
    public function index() {
       return view('BgnRng');
    } 
    
    public function hitungVolumeKubus(Request $request) {
        $sisi = $request->sisi;
        $volume = $sisi * $sisi * $sisi;
        $luaspermukaan = 6 * ($sisi * $sisi);
        return "volume kubus: " . $volume . " dan luas permukaan kubus: " . $luaspermukaan;
    }
    
}
