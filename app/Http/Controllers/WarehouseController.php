<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gudangs = Gudang::all();
        return response()->json($gudangs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);

        $gudang = Gudang::create($request->all());

        return response()->json($gudang, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Gudang $gudang)
    {
        return response()->json($gudang);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gudang $gudang)
    {
        $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'alamat' => 'sometimes|required|string',
        ]);

        $gudang->update($request->all());

        return response()->json($gudang);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gudang $gudang)
    {
        $gudang->delete();

        return response()->json(null, 204);
    }
}