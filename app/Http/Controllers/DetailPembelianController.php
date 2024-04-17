<?php

namespace App\Http\Controllers;

use App\Http\Requests\DetailPembelianRequest;
use App\Models\DetailPembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DetailPembelianController extends Controller
{
    public function __construct(protected DetailPembelian $detail)
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

        $detail = $this->detail;

        $detail->pembelianID = $data['pembelianID'];
        $detail->produkID = $data['produkID'];
        $detail->jumlah = $data['jumlah'];
        $detail->subtotal = $data['subtotal'];

        $detail->save();

        return response()->json($detail);
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailPembelian $detailPembelian)
    {
        //
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
    public function update(Request $request, DetailPembelian $detailPembelian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailPembelian $detailPembelian)
    {
        //
    }
}
