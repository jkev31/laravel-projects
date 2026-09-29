<?php

namespace App\Http\Controllers;

class CtrlItem extends Controller
{
    public function index(){
        $kategori = "Elektronik & Aksesoris";
        
        $items = [
 ['id' => 1, 'nama' => 'Laptop Asus Vivobook', 'harga' => 8500000, 'stok' => 4, 'is_active' =>
true],
 ['id' => 2, 'nama' => 'Mouse Wireless Silent', 'harga' => 125000, 'stok' => 15, 'is_active' =>
true],
 ['id' => 3, 'nama' => 'Flashdisk 64GB USB 3.0', 'harga' => 85000, 'stok' => 0, 'is_active' =>
false],
 ];

        return view('item.katalog', ['kategori' => $kategori, 'items' => $items]);  
    }    
}
