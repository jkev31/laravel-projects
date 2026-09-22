<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductCtrl;
use App\Http\Controllers\KaryawanCtrl;
use App\Http\Controllers\BgnRngCtrl;
use App\Http\Controllers\BgnDtrCtrl;
use App\Http\Controllers\PembelianCtrl;
use App\Http\Controllers\CalculatorController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('products', [ProductCtrl::class, 'products']);
Route::get('dproducts', [ProductCtrl::class, 'detailproducts']);
Route::get('notaproducts/{id}/{nama}', [ProductCtrl::class, 'notaproducts']);
Route::get('formkaryawan', [KaryawanCtrl::class,'formkaryawan']);
Route::post('insertkaryawan', [KaryawanCtrl::class,'insertkaryawan']);


// Route Calculator
// Form input angka
Route::get('/calculator', [CalculatorController::class, 'index']);
// Proses penjumlahan
Route::post('/calculator/add', [CalculatorController::class, 'add']);
// Proses pengurangan
Route::post('/calculator/substract', [CalculatorController::class, 'substract']);
// Proses perkalian
Route::post('/calculator/multiply', [CalculatorController::class, 'multiply']);
// Proses pembagian
Route::post('/calculator/divide', [CalculatorController::class, 'divide']);

// Route Diskon
Route::get('Pembelian', [PembelianCtrl::class,'index']);
Route::post('Pembelian/hitungDiskon', [PembelianCtrl::class,'hitungDiskon']);

// Route Bangun Datar
Route::get('BgnDtr', [BgnDtrCtrl::class,'index']);
Route::post('BgnDtr/hitungLuasPersegi', [BgnDtrCtrl::class,'hitungLuasPersegi']);

// Route Bangun Ruang
Route::get('BgnRng', [BgnRngCtrl::class,'index']);
Route::post('BgnRng/hitungVolumeKubus', [BgnRngCtrl::class,'hitungVolumeKubus']);



