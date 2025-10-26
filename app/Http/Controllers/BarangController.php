<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barang::with(['gudang', 'supplier', 'user'])->get();
        return response()->json($barangs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'kategori' => 'nullable|string|max:255',
            'satuan' => 'nullable|string|max:255',
            'stok' => 'required|integer',
            'gudang_id' => 'required|exists:gudangs,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'user_id' => 'required|exists:users,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/barangs');
            $data['foto'] = Storage::url($path);
        }

        $barang = Barang::create($data);

        return response()->json($barang, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        $barang->load(['gudang', 'supplier', 'user']);
        return response()->json($barang);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'sometimes|required|string|max:255',
            'harga' => 'sometimes|required|numeric',
            'kategori' => 'nullable|string|max:255',
            'satuan' => 'nullable|string|max:255',
            'stok' => 'sometimes|required|integer',
            'gudang_id' => 'sometimes|required|exists:gudangs,id',
            'supplier_id' => 'sometimes|required|exists:suppliers,id',
            'user_id' => 'sometimes|required|exists:users,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            // Delete old photo if it exists
            if ($barang->foto) {
                Storage::delete(str_replace('/storage', 'public', $barang->foto));
            }

            $path = $request->file('foto')->store('public/barangs');
            $data['foto'] = Storage::url($path);
        }

        $barang->update($data);

        return response()->json($barang);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        // Delete photo if it exists
        if ($barang->foto) {
            Storage::delete(str_replace('/storage', 'public', $barang->foto));
        }

        $barang->delete();

        return response()->json(null, 204);
    }
}