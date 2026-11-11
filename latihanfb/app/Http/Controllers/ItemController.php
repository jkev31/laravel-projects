<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Illuminate\View\View;
class ItemController extends Controller
{
    protected $firestore;

    public function __construct()
    {
        // Inisialisasi koneksi Firestore
        $this->firestore = Firebase::firestore()->database();
    }

    // 1. TAMPILKAN DAFTAR ITEM (READ)
    public function index()
    {
        $documents = $this->firestore->collection('items')->documents();
        $item = [];

        foreach ($documents as $doc) {
            if ($doc->exists()) {
                // Konversi data array Firestore + Document ID menjadi Objek PHP
                $item[] = (object) array_merge(['id' => $doc->id()], $doc->data());
            }
        }

        return view('items.index', ['item' => $item]);
    }

    // 2. TAMPILKAN FORM TAMBAH
    public function create()
    {
        return view('items.create');
    }

    // 3. SIMPAN ITEM BARU (CREATE)
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'tgl_terima'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Tambah Dokumen ke Koleksi 'items' di Firestore
        $this->firestore->collection('items')->add([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => (float) ($request->price * 1000),
            'stock'       => (int) $request->stock,
            'tgl_terima'  => $request->tgl_terima,
            'created_at'  => now()->toDateTimeString(),
            'updated_at'  => now()->toDateTimeString(),
        ]);

        return response()->json(['status' => true, 'message' => 'Item berhasil ditambahkan!']);
    }

    // 4. TAMPILKAN FORM EDIT
    public function edit($id)
    {
        $doc = $this->firestore->collection('items')->document($id)->snapshot();

        if (!$doc->exists()) {
            return redirect('items')->with('error', 'Data tidak ditemukan!');
        }

        $itemData = (object) array_merge(['id' => $doc->id()], $doc->data());

        // Dikemas dalam array agar kompatibel dengan @foreach ($item as $x) di Blade edit
        return view('items.edit', ['item' => [$itemData]]);
    }

    // 5. UPDATE ITEM (UPDATE)
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'          => 'required',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'tgl_terima'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Update Dokumen berdasarkan ID di Firestore
        $this->firestore->collection('items')->document($request->id)->set([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => (float) $request->price,
            'stock'       => (int) $request->stock,
            'tgl_terima'  => $request->tgl_terima,
            'updated_at'  => now()->toDateTimeString(),
        ], ['merge' => true]);

        return response()->json(['status' => true, 'message' => 'Item berhasil diupdate!']);
    }

    // 6. HAPUS ITEM (DELETE)
    public function destroy(Request $request)
    {
        // Hapus Dokumen dari Firestore berdasarkan ID
        $this->firestore->collection('items')->document($request->id)->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Item berhasil dihapus!'
        ]);
    }
    


}
