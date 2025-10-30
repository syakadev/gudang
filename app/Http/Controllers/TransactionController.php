<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Item;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $data = $request->all();
        $data['invoice_number'] = 'INV/' . now()->format('Ymd') . '/' . str_pad(Transaction::whereDate('created_at', today())->count() + 1, 3, '0', STR_PAD_LEFT);


        Transaction::create($data);

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
        $customers = Customer::all();
        $suppliers = Supplier::all();
        $items = Item::all();
        $transactionDetails = TransactionDetail::where('transaction_id', $transaction->id)->get();
        return view('transactions.edit', compact('transaction', 'customers', 'suppliers', 'items', 'transactionDetails'));
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
