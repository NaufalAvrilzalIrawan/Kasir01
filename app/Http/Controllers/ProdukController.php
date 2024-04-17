<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdukRequest;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{

    public function __construct(protected Produk $produk)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = $this->produk->get();

        return response()->json($produk);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProdukRequest $request)
    {
        $data = $request->validated();
        $produk = $this->produk;

        $produk->namaProduk = $data['namaProduk'];
        $produk->harga = $data['harga'] ?? null;
        $produk->stok = $data['stok'] ?? null;

        $produk->save();
        return response()->json($produk);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produk = $this->produk->where('produkID', $id)->first();
        if ($produk == null) {
            return response()->json('Data dengan id ' . $id . ' tidak ditemukan');
        }

        return response()->json($produk);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProdukRequest $request, $id)
    {
        $data = $request->validated();
        $produk = $this->produk->find($id);
        if ($produk == null) {
            return response()->json('Data dengan id ' . $id . ' tidak ditemukan');
        }

        $produk->namaProduk = $data['namaProduk'];
        $produk->harga = $data['harga'];
        $produk->stok = $data['stok'];

        $produk->update();
        return response()->json($produk);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = $this->produk->find($id);
        if ($produk == null) {
            return response()->json('Data dengan id ' . $id . ' tidak ditemukan');
        }
        $produk->delete();

        return response()->json($produk);
    }
}
