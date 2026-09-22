<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function index() {
        return view('calculator');
    }

    // Penjumlahan
    public function add(Request $request) {
        $result = $request->number1 + $request->number2;
        return "Hasil Penjumlahan: " . $result;
    }
    // Pengurangan
    public function substract(Request $request) {
        $result = $request->number1 - $request->number2;
        return "Hasil Pengurangan: " . $result;
    }
    // Perkalian
    public function multiply(Request $request) {
        $result = $request->number1 * $request->number2;
        return "Hasil Perkalian: " . $result;
    }
    // Pembagian
    public function divide(Request $request) {
        if ($request->number2 == 0) {
            return "Tidak bisa dibagi dengan nol";
        }
        $result = $request->number1 / $request->number2;
        return "Hasil Pembagian: " . $result;
    }
}
