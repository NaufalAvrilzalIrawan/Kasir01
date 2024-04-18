<?php

namespace App\Http\Controllers;

use App\Http\Requests\DetailPembelianRequest;
use App\Models\DetailPembelian;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DetailPembelianController extends Controller
{
    public function __construct(protected DetailPembelian $detail, protected Produk $produk)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detail = $this->detail->get();

        return response()->json($detail);
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
    public function store(DetailPembelianRequest $request)
    {
        $data = $request->validated();
        $produkID = $data['produkID'];
        $jumlah = $data['jumlah'];
        $produk = $this->produk->find($produkID);
        $subtotal = $produk->harga * $jumlah;

        $detail = $this->detail;

        $detail->pembelianID = $data['pembelianID'];
        $detail->produkID = $produkID;
        $detail->jumlah = $jumlah;
        $detail->subtotal = $subtotal;
        dd($detail);

        $detail->save();

        return response()->json($detail);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $detail = $this->detail->find($id);

        return response()->json($detail);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailPembelian $detailPembelian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DetailPembelianRequest $request, $id)
    {
        $data = $request->validated();
        $detail = $this ->detail->finde($id);
        if ($detail == null) {
            return response()->json('data dengan id ' . $id . ' tidak ditemukan');
        }

        $detail->pembelianID = $data['pembelianID'];
        $detail->produkID = $data['produkID'];
        $detail->jumlah = $data['jumlah'];
        $detail->subtotal = $data['subtotal'];

        $detail->update();
        return response()->json($detail);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $detail = $this->detail->find($id);
        $detail->delete();

        return response()->json($detail);
    }
}
