<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PenjualanCtrl extends Controller
{
    public function katalog(){
        
        
        $items = [
            ['kode' => 1, 'nama_item' => 'masker', 'kategori' => 'outfit', 'harga' => 20000, 'diskon_persen' => 15],
            ['kode' => 2, 'nama_item' => 'jaket', 'kategori' => 'outfit', 'harga' => 100000, 'diskon_persen' => 20],
            ['kode' => 3, 'nama_item' => 'cola', 'kategori' => 'drink', 'harga' => 8000, 'diskon_persen' => 30],
            ['kode' => 4, 'nama_item' => 'sprite', 'kategori' => 'drink', 'harga' => 10000, 'diskon_persen' => 5],
            ['kode' => 5, 'nama_item' => 'indomie', 'kategori' => 'food', 'harga' => 5000, 'diskon_persen' => 50],
        ];

        return view('penjualan.katalog', ['items' => $items]);  
    }  
    
   
}
