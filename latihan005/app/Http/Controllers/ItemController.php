<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
class ItemController extends Controller
{
    public function index()
    {
        $item = DB::table('items')->get();
        return view('items.index',['item'=>$item]);
    }

    // CREATE: Menyimpan data baru
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
                ], 422);
            }
        DB::table('items')->insert([
            'name' => $request->name,
            'desc' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Item berhasil ditambahkan!'
        ]);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::table('items')->where('id', $id)->update([
            'name' => $request->name,
            'desc' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'updated_at' => now(),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Item berhasil diupdate!'
        ]);
    }
    public function destroy($id)
    {
        DB::table('items')->where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Item berhasil dihapus!'
        ]);
    }
    


}
