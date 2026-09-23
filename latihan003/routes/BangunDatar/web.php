<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BgnDtrCtrl;

Route::get('/BgnDtr', [BgnDtrCtrl::class,'index']);
Route::post('/pilihMenu', [BgnDtrCtrl::class,'pilihMenu']);
Route::post('/hitungPersegi', [BgnDtrCtrl::class,'hitungPersegi']);
Route::post('/hitungSegitiga', [BgnDtrCtrl::class,'hitungSegitiga']);
Route::post('/hitungLingkaran', [BgnDtrCtrl::class,'hitungLingkaran']);