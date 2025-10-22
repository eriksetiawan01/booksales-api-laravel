<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user', 'book')->get();

        if ($transactions->isEmpty()) {
            return response()->json([
                "success" => true,
                "message" => "Resources data not found",
            ], 200);
        }

        return response()->json([
            "success" => true,
            "message" => "Get all resources",
            "data" => $transactions
        ], 200);
    }

    public function store(Request $request)
    {
        //1. validator & cek validator
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Validation Error.",
                "data" => $validator->errors()
            ], 422);
        }

        //2. generate order number -> unique  | ORD-0003
        $uniqueCode = "ORD" . strtoupper(uniqid());

        //3. ambil user yang sedang login & cek login (apakah ada data user? )
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                "success" => false,
                "message" => "Unauthorized. Please login to continue.",
            ], 401);
        }
        //4. mencari data buku dari request
        $book = Book::find($request->book_id);

        //5. cek stock buku
        if ($book->stock < $request->quantity) {
            return response()->json ([
                "success" => false,
                "message" => "Stok barang tidak mencukupi.",
            ], 400);
        }

        //6. hitung total harga = price * quantity
        $totalAmount = $book->price * $request->quantity;

        //7. kurangi stock buku (update)
        $book->stock -= $request->quantity;
        $book->save();

        //8. simpan data transaksi
        $transaction = Transaction::create([
            'order_number' => $uniqueCode,
            'customer_id' => $user->id,
            'book_id' => $request->book_id,
            'total_amount' => $totalAmount,
        ]);

        return response()->json([
            "success" => true,
            "message" => "Transaction created successfully",
            "data" => $transaction
        ], 201);
    }

    public function show(string $id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                "success" => false,
                "message" => "Resource not found",
            ], 404);
        }

        return response()->json([
            "success" => true,
            "message" => "Get detail resource",
            "data" => $transaction
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json([
                "success" => false, 
                "message" => "Resource not found"
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false, 
                "message" => "Validation Error.", 
                "data" => $validator->errors()], 422);
        }

        $oldBook = Book::find($transaction->book_id);
        $newBook = Book::find($request->book_id);

        // Hitung quantity lama
        $oldQuantity = $transaction->total_amount / $oldBook->price;

        if ($oldBook->id == $newBook->id) {
            // Selisih stok jika buku sama
            $quantityDifference = $request->quantity - $oldQuantity;
            if ($quantityDifference > 0 && $newBook->stock < $quantityDifference) {
                return response()->json([
                    "success" => false, 
                    "message" => "Stok buku tidak mencukupi."
                ], 400);
            }
            $newBook->stock -= $quantityDifference;
            $newBook->save();
        } else {
            // Hitung stok buku lama dan baru
            if ($newBook->stock < $request->quantity) {
                return response()->json([
                    "success" => false, 
                    "message" => "Stok buku tidak mencukupi."
                ], 400);
            }

            $oldBook->stock += $oldQuantity;        // kembalikan stok lama
            $oldBook->save();

            $newBook->stock -= $request->quantity; // kurangi stok baru
            $newBook->save();
        }

        // Update transaksi
        $transaction->book_id = $request->book_id;
        $transaction->total_amount = $newBook->price * $request->quantity;
        $transaction->save();

        return response()->json([
            "success" => true,
            "message" => "Transaction updated successfully",
            "data" => $transaction
        ], 200);
    }


    public function destroy(string $id)
    {
        // Cari transaksi berdasarkan ID
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                "success" => false,
                "message" => "Transaction not found",
            ], 404);
        }

        // Hapus transaksi dari database
        $transaction->delete();

        return response()->json([
            "success" => true,
            "message" => "Transaction deleted successfully",
        ], 200);
    }


}
