<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class KaryawanCtrl extends Controller
{
    public function formkaryawan() {
        return view('formkaryawan');
    }
    public function insertkaryawan(Request $r) {
        echo "hasil";
        echo "<br>";
        echo $r->kode;
        echo "<br>";
        echo $r->nama;
        echo "<br>";
        echo $r->umur;
    }
}
