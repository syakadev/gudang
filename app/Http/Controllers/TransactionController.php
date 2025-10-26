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
        $transactions = Transaction::with(['user', 'customer', 'transactionDetails'])->latest()->paginate(5);
        return view('transactions.index', compact('transactions'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transactions.create');
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

        Transaction::create($request->all());

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
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

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction deleted successfully');
    }
}
