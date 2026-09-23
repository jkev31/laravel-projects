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

    public function hitungVolumeBalok(Request $request) {
        $panjang = $request->panjang;
        $lebar = $request->lebar;
        $tinggi = $request->tinggi;
        $volume = $panjang * $lebar * $tinggi;
        $luaspermukaan = 2 * (($panjang * $lebar) + ($panjang * $tinggi) + ($lebar * $tinggi));
        return "volume balok: " . $volume . " dan luas permukaan balok: " . $luaspermukaan;
    }

    public function hitungVolumeTabung(Request $request) {
        $radius = $request->radius;
        $tinggi = $request->tinggi;
        $volume = (3.14 * $radius * $radius) * $tinggi;
        $luaspermukaan = 2 * 3.14 * $radius * ($radius + $tinggi);
        return "volume tabung: " . $volume . " dan luas permukaan tabung: " . $luaspermukaan;
    }
    
}
