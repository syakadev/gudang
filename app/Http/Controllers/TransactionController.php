<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksis = Transaksi::with(['user', 'pelanggan', 'detailTransaksis'])->get();
        return response()->json($transaksis);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'catatan' => 'nullable|string',
            'tanggal' => 'required|date',
            'total_harga' => 'required|numeric',
            'alamat_pengiriman' => 'nullable|string',
            'jenis_transaksi' => 'required|in:masuk,keluar',
            'user_id' => 'required|exists:users,id',
            'pelanggan_id' => 'nullable|exists:pelanggans,id',
        ]);

        $transaksi = Transaksi::create($request->all());

        return response()->json($transaksi, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        $transaksi->load(['user', 'pelanggan', 'detailTransaksis']);
        return response()->json($transaksi);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'catatan' => 'nullable|string',
            'tanggal' => 'sometimes|required|date',
            'total_harga' => 'sometimes|required|numeric',
            'alamat_pengiriman' => 'nullable|string',
            'jenis_transaksi' => 'sometimes|required|in:masuk,keluar',
            'user_id' => 'sometimes|required|exists:users,id',
            'pelanggan_id' => 'nullable|exists:pelanggans,id',
        ]);

        $transaksi->update($request->all());

        return response()->json($transaksi);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return response()->json(null, 204);
    }
}