<?php

namespace App\Http\Controllers;

class ItemCtrl extends Controller
{
    public function index(){
        $kategori = "Elektronik & Aksesoris";
        
        $items = [
            ['id' => 1, 'nama' => 'Laptop Asus Vivobook', 'harga' => 8500000, 'stok' => 4, 'is_active' => true],
            ['id' => 2, 'nama' => 'Mouse Wireless Silent', 'harga' => 125000, 'stok' => 15, 'is_active' => true],
            ['id' => 3, 'nama' => 'Flashdisk 64GB USB 3.0', 'harga' => 85000, 'stok' => 0, 'is_active' => false],
        ];

        return view('item.katalog', ['kategori' => $kategori, 'items' => $items]);  
    }  
    
    public function karyawan(){
        $divisi = 'Teknisi';
        $karyawan = [
            ['id' => 1, 'nama' => 'Andi', 'jabatan' => 'Manager', 'hadir' => true],
            ['id' => 2, 'nama' => 'Budi', 'jabatan' => 'Staff', 'hadir' => true],
            ['id' => 3, 'nama' => 'Citra', 'jabatan' => 'Staff', 'hadir' => false],
        ];
        return view('item.karyawan', ['karyawan' => $karyawan, 'divisi' => $divisi]);
    }
    public function supplier(){
        $supplier = [
            ['id' => 1, 'nama' => 'PT. Supplyindo', 'lokasi' => 'Jakarta', 'is_active' => true],
            ['id' => 2, 'nama' => 'PT. Sinar Abadi', 'lokasi' => 'Bandung', 'is_active' => true],
            ['id' => 3, 'nama' => 'PT. Jaya Makmur', 'lokasi' => 'Surabaya', 'is_active' => false],
        ];
        return view('item.supplier', ['supplier' => $supplier]);
    }
}
