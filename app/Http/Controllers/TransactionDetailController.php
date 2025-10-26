<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class TransactionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactionDetails = TransactionDetail::with(['transaction', 'item'])->latest()->paginate(5);
        return view('transaction_details.index', compact('transactionDetails'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transaction_details.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer',
            'total_price' => 'required|numeric',
        ]);

        TransactionDetail::create($request->all());

        return redirect()->route('transaction_details.index')
            ->with('success', 'Transaction Detail created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TransactionDetail $transactionDetail)
    {
        return view('transaction_details.show', compact('transactionDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransactionDetail $transactionDetail)
    {
        return view('transaction_details.edit', compact('transactionDetail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransactionDetail $transactionDetail)
    {
        $request->validate([
            'transaction_id' => 'sometimes|required|exists:transactions,id',
            'item_id' => 'sometimes|required|exists:items,id',
            'quantity' => 'sometimes|required|integer',
            'total_price' => 'sometimes|required|numeric',
        ]);

        $transactionDetail->update($request->all());

        return redirect()->route('transaction_details.index')
            ->with('success', 'Transaction Detail updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransactionDetail $transactionDetail)
    {
        $transactionDetail->delete();

        return redirect()->route('transaction_details.index')
            ->with('success', 'Transaction Detail deleted successfully');
    }
}