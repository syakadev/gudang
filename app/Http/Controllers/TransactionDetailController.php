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
        $transactionDetails = TransactionDetail::with(['transaction', 'item'])->get();
        return response()->json($transactionDetails);
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

        $transactionDetail = TransactionDetail::create($request->all());

        return response()->json($transactionDetail, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TransactionDetail $transactionDetail)
    {
        $transactionDetail->load(['transaction', 'item']);
        return response()->json($transactionDetail);
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

        return response()->json($transactionDetail);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransactionDetail $transactionDetail)
    {
        $transactionDetail->delete();

        return response()->json(null, 204);
    }
}