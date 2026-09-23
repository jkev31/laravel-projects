<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BgnDtrCtrl;

Route::get('/MenuBgnDtr', [BgnDtrCtrl::class,'index']);
Route::post('/inputData', [BgnDtrCtrl::class,'inputData']);
Route::post('/hitungPersegi', [BgnDtrCtrl::class,'hitungPersegi']);
Route::post('/hitungSegitiga', [BgnDtrCtrl::class,'hitungSegitiga']);
Route::post('/hitungLingkaran', [BgnDtrCtrl::class,'hitungLingkaran']);