<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with(['user', 'customer', 'transactionDetails'])->get();
        return response()->json($transactions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'notes' => 'nullable|string',
            'transaction_date' => 'required|date',
            'total_price' => 'required|numeric',
            'shipping_address' => 'nullable|string',
            'transaction_type' => 'required|in:in,out',
            'user_id' => 'required|exists:users,id',
            'customer_id' => 'nullable|exists:customers,id',
        ]);

        $transaction = Transaction::create($request->all());

        return response()->json($transaction, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $transaction->load(['user', 'customer', 'transactionDetails']);
        return response()->json($transaction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'notes' => 'nullable|string',
            'transaction_date' => 'sometimes|required|date',
            'total_price' => 'sometimes|required|numeric',
            'shipping_address' => 'nullable|string',
            'transaction_type' => 'sometimes|required|in:in,out',
            'user_id' => 'sometimes|required|exists:users,id',
            'customer_id' => 'nullable|exists:customers,id',
        ]);

        $transaction->update($request->all());

        return response()->json($transaction);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return response()->json(null, 204);
    }
}
