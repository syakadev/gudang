<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Warehouse;
use App\Models\Supplier;
use App\Models\User;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::with(['warehouse', 'supplier', 'user'])->latest()->paginate(5);
        return view('items.index', compact('items'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $warehouses = Warehouse::all();
        $suppliers = Supplier::all();
        $users = User::all();

        return view('items.create', compact('warehouses', 'suppliers', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category' => 'nullable|string|max:255',
            'unit' => 'nullable|string|max:255',
            'stock' => 'required|integer',
            'warehouse_id' => 'required|exists:warehouses,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'user_id' => 'required|exists:users,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/items');
            $data['photo'] = Storage::url($path);
        }

        Item::create($data);

        return redirect()->route('items.index')
            ->with('success', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $werehouse = Warehouse::where('id', $item->warehouse_id)->first();
        $supplier = Supplier::where('id', $item->supplier_id)->first();
        $user = User::where('id', $item->user_id)->first();

        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric',
            'category' => 'nullable|string|max:255',
            'unit' => 'nullable|string|max:255',
            'stock' => 'sometimes|required|integer',
            'warehouse_id' => 'sometimes|required|exists:warehouses,id',
            'supplier_id' => 'sometimes|required|exists:suppliers,id',
            'user_id' => 'sometimes|required|exists:users,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            // Delete old photo if it exists
            if ($item->photo) {
                Storage::delete(str_replace('/storage', 'public', $item->photo));
            }

            $path = $request->file('photo')->store('public/items');
            $data['photo'] = Storage::url($path);
        }

        $item->update($data);

        return redirect()->route('items.index')
            ->with('success', 'Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        // Delete photo if it exists
        if ($item->photo) {
            Storage::delete(str_replace('/storage', 'public', $item->photo));
        }

        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Item deleted successfully');
    }
}
