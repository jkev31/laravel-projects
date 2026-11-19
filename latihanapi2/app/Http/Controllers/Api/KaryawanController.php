<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    // 1. GET: Membaca Semua Data Karyawan + Filter Query Parameter (200 OK)
    public function index(Request $request)
    {
        $query = DB::table('karyawans');

        // Menangkap Query Parameter: /api/karyawans?pendidikan=S1
        if ($request->has('pendidikan')) {
            $query->where('pendidikan', $request->query('pendidikan'));
        }

        $karyawans = $query->get();

        return response()->json([
            'success' => true,
            'data'    => $karyawans
        ], 200);
    }

    // 2. GET: Membaca Satu Data Karyawan berdasarkan ID (200 OK / 404 Not Found)
    public function show(string $id)
    {
        $karyawan = DB::table('karyawans')->where('id', $id)->first();

        if (!$karyawan) {
            return response()->json([
                'success' => false,
                'message' => 'Resource Karyawan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $karyawan
        ], 200);
    }

    // 3. POST: Menyimpan Data Karyawan Baru ke Database (201 Created / 400 Bad Request)
    public function store(Request $request)
    {
        $clientApp = $request->header('X-Client-App');

        // Validasi Sederhana Request Body (wajib nama dan telp)
        if (!$request->has('nama') || !$request->has('telp')) {
            return response()->json([
                'success' => false,
                'message' => 'Bad Request: Field nama dan telp wajib diisi'
            ], 400);
        }

        $newId = DB::table('karyawans')->insertGetId([
            'nama'       => $request->input('nama'),
            'alamat'     => $request->input('alamat', null),
            'telp'       => $request->input('telp'),
            'umur'       => $request->input('umur', 18),
            'pendidikan' => $request->input('pendidikan', 'SMA/SMK'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $newKaryawan = DB::table('karyawans')->where('id', $newId)->first();

        return response()->json([
            'success'       => true,
            'message'       => 'Data karyawan berhasil dibuat',
            'client_source' => $clientApp ?? 'Unknown',
            'data'          => $newKaryawan
        ], 201);
    }

    // 4. PUT: Full Replacement (200 OK / 400 / 404)
    public function updatePut(Request $request, string $id)
    {
        $karyawan = DB::table('karyawans')->where('id', $id)->first();

        if (!$karyawan) {
            return response()->json([
                'success' => false,
                'message' => 'Data karyawan tidak ditemukan'
            ], 404);
        }

        // Pada PUT, seluruh field utama wajib dikirim untuk menggantikan data lama
        if (!$request->has('nama') || !$request->has('telp')) {
            return response()->json([
                'success' => false,
                'message' => 'Bad Request: PUT mewajibkan pengiriman seluruh data (minimal nama & telp)'
            ], 400);
        }

        DB::table('karyawans')->where('id', $id)->update([
            'nama'       => $request->input('nama'),
            'alamat'     => $request->input('alamat', null),
            'telp'       => $request->input('telp'),
            'umur'       => $request->input('umur', 18),
            'pendidikan' => $request->input('pendidikan', 'SMA/SMK'),
            'updated_at' => now(),
        ]);

        $updatedData = DB::table('karyawans')->where('id', $id)->first();

        return response()->json([
            'method' => 'PUT (Full Replace)',
            'data'   => $updatedData
        ], 200);
    }

    // 5. PATCH: Partial Modification (200 OK / 404)
    public function updatePatch(Request $request, string $id)
    {
        $karyawan = DB::table('karyawans')->where('id', $id)->first();

        if (!$karyawan) {
            return response()->json([
                'success' => false,
                'message' => 'Data karyawan tidak ditemukan'
            ], 404);
        }

        // Kumpulkan hanya field yang dikirimkan di request
        $updateFields = [];
        if ($request->has('nama'))       $updateFields['nama']       = $request->input('nama');
        if ($request->has('alamat'))     $updateFields['alamat']     = $request->input('alamat');
        if ($request->has('telp'))       $updateFields['telp']       = $request->input('telp');
        if ($request->has('umur'))       $updateFields['umur']       = $request->input('umur');
        if ($request->has('pendidikan')) $updateFields['pendidikan'] = $request->input('pendidikan');

        if (!empty($updateFields)) {
            $updateFields['updated_at'] = now();
            DB::table('karyawans')->where('id', $id)->update($updateFields);
        }

        $updatedKaryawan = DB::table('karyawans')->where('id', $id)->first();

        return response()->json([
            'method' => 'PATCH (Partial Update)',
            'data'   => $updatedKaryawan
        ], 200);
    }

    // 6. DELETE: Menghapus Data Karyawan (204 No Content / 404)
    public function destroy(string $id)
    {
        $karyawan = DB::table('karyawans')->where('id', $id)->first();

        if (!$karyawan) {
            return response()->json([
                'success' => false,
                'message' => 'Data karyawan tidak ditemukan'
            ], 404);
        }

        DB::table('karyawans')->where('id', $id)->delete();

        return response()->noContent(); // Status Code 204 No Content
    }

    // 7. POST: Pengecekan Header Authorization (Contoh untuk Bonus / Kenaikan Gaji)
    public function bonus(Request $request)
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader) {
            return response()->json([
                'success' => false,
                'message' => 'Token autentikasi tidak ditemukan'
            ], 401);
        }

        if ($authHeader === 'Bearer user-token') {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak: Hanya Admin/HRD yang boleh memberikan bonus'
            ], 403);
        }

        if ($authHeader === 'Bearer admin-token') {
            return response()->json([
                'success' => true,
                'message' => 'Bonus karyawan berhasil diterapkan'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Token autentikasi tidak valid'
        ], 401);
    }
}