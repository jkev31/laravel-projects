<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class TransactionController extends Controller {
    public function index() {
        $transactions = DB::table('transactions')->get();
        return view('Transactions.index',['transactions' => $transactions]);
    }


    public function create() {
        $items = DB::table('items')->get();
        return view('Transactions.create',['items' => $items]);
    }

    public function rekapDetail() {
        $details = DB::table('transaction_details as D')
            ->join('items as I', 'I.id', '=', 'D.item_id')
            ->join('transactions as T', 'T.id', '=', 'D.transaction_id')
            ->select(
                'T.invoice_number',
                'T.transaction_date',
                'D.item_id',
                'I.name',
                'I.description',
                'D.price',
                'D.quantity',
                'D.subtotal'
            )
            ->get();

        return view('Transactions.rekapdetail', compact('details'));
    }


    public function store(Request $request) {
        // 1. Validasi Input
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:items,id', 
            'items.*.qty' => 'required|numeric|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);
        
        // 2. Jalankan Database Transaction
        try {
            DB::beginTransaction();
            
            // Hitung Grand Total di sisi server
            $grandTotal = 0;
            foreach ($request->items as $item) {
                $grandTotal += $item['qty'] * $item['price'];
            }
            
            // Simpan Data Header Transaksi dan Ambil ID yang Baru Dibuat
            $invoiceNumber = 'TRX-' . date('YmdHis');
            $transactionId = DB::table("transactions")->insertGetId([
                'invoice_number' => $invoiceNumber,
                'transaction_date' => $request->tanggal,
                'description' => $request->keterangan,
                'total_amount' => $grandTotal,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Simpan Detail Transaksi dan Update Stok Barang
            foreach ($request->items as $item) {
                DB::table("transaction_details")->insert([
                    'transaction_id' => $transactionId, // Menggunakan $transactionId hasil insertGetId
                    'item_id' => $item['id'],
                    'quantity' => $item['qty'],
                    'price' => $item['price'],
                    'subtotal' => $item['qty'] * $item['price'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                
                // Pengurangan stok barang di database
                DB::table("items")->where('id', $item['id'])->decrement('stock', $item['qty']);
            }

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Transaksi berhasil disimpan!',
                'data' => [
                    'id' => $transactionId,
                    'invoice_number' => $invoiceNumber,
                    'total_amount' => $grandTotal
                ]
            ], 200);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id) {
        // 1. Ambil data header transaksi
        $transaction = DB::table('transactions')
            ->where('id', $id)
            ->first();
            
        if (!$transaction) {
            abort(404, 'Transaksi tidak ditemukan');
        }
            
        // 2. Ambil data detail transaksi join dengan tabel items untuk mengambil nama barang
        $details = DB::table('transaction_details')
            ->join('items', 'transaction_details.item_id', '=', 'items.id')
            ->select(
                'transaction_details.*',
                'items.name as item_name'
            )
            ->where('transaction_details.transaction_id', $id)
            ->get();
            
        // 3. Return view
        return view('Transactions.show', compact('transaction', 'details'));
    }
}
