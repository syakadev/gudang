<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use Illuminate\Http\Request;

class DetailTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detailTransaksis = DetailTransaksi::with(['transaksi', 'barang'])->get();
        return response()->json($detailTransaksis);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'transaksi_id' => 'required|exists:transaksis,id',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah_barang' => 'required|integer',
            'total_harga' => 'required|numeric',
        ]);

        $detailTransaksi = DetailTransaksi::create($request->all());

        return response()->json($detailTransaksi, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailTransaksi $detailTransaksi)
    {
        $detailTransaksi->load(['transaksi', 'barang']);
        return response()->json($detailTransaksi);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailTransaksi $detailTransaksi)
    {
        $request->validate([
            'transaksi_id' => 'sometimes|required|exists:transaksis,id',
            'barang_id' => 'sometimes|required|exists:barangs,id',
            'jumlah_barang' => 'sometimes|required|integer',
            'total_harga' => 'sometimes|required|numeric',
        ]);

        $detailTransaksi->update($request->all());

        return response()->json($detailTransaksi);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailTransaksi $detailTransaksi)
    {
        $detailTransaksi->delete();

        return response()->json(null, 204);
    }
}