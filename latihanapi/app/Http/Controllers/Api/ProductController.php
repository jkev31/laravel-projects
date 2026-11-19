<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // 1. GET: Membaca Semua Data + Filter Query Parameter (200 OK)
    public function index(Request $request)
    {
        $query = DB::table('products');

        // Menangkap Query Parameter: /api/products?category=electronics
        if ($request->has('category')) {
            $query->where('category', $request->query('category'));
        }

        $products = $query->get();

        return response()->json([
            'success' => true,
            'data'    => $products
        ], 200);
    }

    // 2. GET: Membaca Satu Data berdasarkan ID (200 OK / 404 Not Found)
    public function show(string $id)
    {
        $product = DB::table('products')->where('id', $id)->first();

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Resource Produk tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $product
        ], 200);
    }

    // 3. POST: Menyimpan Data Baru ke Database (201 Created / 400 Bad Request)
    public function store(Request $request)
    {
        // Memeriksa Custom Header
        $clientApp = $request->header('X-Client-App');

        // Validasi Sederhana Request Body
        if (!$request->has('name') || !$request->has('price')) {
            return response()->json([
                'success' => false,
                'message' => 'Bad Request: Field name dan price wajib diisi'
            ], 400);
        }

        // Insert ke database dan ambil ID barunya
        $newId = DB::table('products')->insertGetId([
            'name'       => $request->input('name'),
            'category'   => $request->input('category', 'uncategorized'),
            'price'      => $request->input('price'),
            'stock'      => $request->input('stock', 0),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $newProduct = DB::table('products')->where('id', $newId)->first();

        return response()->json([
            'success'       => true,
            'message'       => 'Produk berhasil dibuat',
            'client_source' => $clientApp ?? 'Unknown',
            'data'          => $newProduct
        ], 201);
    }

    // 4. PUT: Full Replacement (200 OK / 400 / 404)
    public function updatePut(Request $request, string $id)
    {
        $product = DB::table('products')->where('id', $id)->first();

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        // Pada PUT, seluruh field utama wajib dikirim untuk menggantikan data lama
        if (!$request->has('name') || !$request->has('price')) {
            return response()->json([
                'success' => false,
                'message' => 'Bad Request: PUT mewajibkan pengiriman seluruh data (minimal name & price)'
            ], 400);
        }

        DB::table('products')->where('id', $id)->update([
            'name'       => $request->input('name'),
            'category'   => $request->input('category', 'uncategorized'),
            'price'      => $request->input('price'),
            'stock'      => $request->input('stock', 0),
            'updated_at' => now(),
        ]);

        $updatedData = DB::table('products')->where('id', $id)->first();

        return response()->json([
            'method' => 'PUT (Full Replace)',
            'data'   => $updatedData
        ], 200);
    }

    // 5. PATCH: Partial Modification (200 OK / 404)
    public function updatePatch(Request $request, string $id)
    {
        $product = DB::table('products')->where('id', $id)->first();

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        // Kumpulkan hanya field yang dikirimkan di request
        $updateFields = [];
        if ($request->has('name'))     $updateFields['name']     = $request->input('name');
        if ($request->has('category')) $updateFields['category'] = $request->input('category');
        if ($request->has('price'))    $updateFields['price']    = $request->input('price');
        if ($request->has('stock'))    $updateFields['stock']    = $request->input('stock');

        if (!empty($updateFields)) {
            $updateFields['updated_at'] = now();
            DB::table('products')->where('id', $id)->update($updateFields);
        }

        $updatedProduct = DB::table('products')->where('id', $id)->first();

        return response()->json([
            'method' => 'PATCH (Partial Update)',
            'data'   => $updatedProduct
        ], 200);
    }

    // 6. DELETE: Menghapus Data dari Database (204 No Content / 404)
    public function destroy(string $id)
    {
        $product = DB::table('products')->where('id', $id)->first();

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        DB::table('products')->where('id', $id)->delete();

        return response()->noContent(); // Status Code 204 No Content
    }

    // 7. POST: Pengecekan Header Authorization untuk Diskon (200 / 401 / 403)
    public function discount(Request $request)
    {
        // Ambil nilai Header Authorization
        $authHeader = $request->header('Authorization');

        // 1. Jika Header Authorization tidak dikirimkan atau kosong -> 401 Unauthorized
        if (!$authHeader) {
            return response()->json([
                'success' => false,
                'message' => 'Token autentikasi tidak ditemukan'
            ], 401);
        }

        // 2. Jika diisi dengan Bearer user-token -> 403 Forbidden
        if ($authHeader === 'Bearer user-token') {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak: Hanya Admin yang boleh memberikan diskon'
            ], 403);
        }

        // 3. Jika diisi dengan Bearer admin-token -> 200 OK
        if ($authHeader === 'Bearer admin-token') {
            return response()->json([
                'success' => true,
                'message' => 'Diskon berhasil diterapkan'
            ], 200);
        }

        // Tambahan jika token diisi selain user-token / admin-token
        return response()->json([
            'success' => false,
            'message' => 'Token autentikasi tidak valid'
        ], 401);
    }
}