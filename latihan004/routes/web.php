<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CtrlItem;
use App\Http\Controllers\ItemCtrl;
// use App\Http\Controllers\PenjualanCtrl; //

Route::get('/', function () {
    return view('welcome');
});

Route::get('view', [CtrlItem::class,'index']);
Route::post('katalog', [ItemCtrl::class,'index']);
Route::post('karyawan', [ItemCtrl::class,'karyawan']);
Route::post('supplier', [ItemCtrl::class,'supplier']); 
// Route::get('katalog', [PenjualanCtrl::class,'katalog']); //

