<?php

namespace App\Http\Controllers;

use App\Http\Requests\DetailPembelianRequest;
use App\Models\DetailPembelian;
use App\Models\Pembelian;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DetailPembelianController extends Controller
{
    public function __construct(protected DetailPembelian $detail, protected Produk $produk, protected Pembelian $pembelian)
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
        $produk = $this->produk->find($produkID);
        $stok = $produk->stok - $data['jumlah'];
        $produk->stok = $stok;
        $produk->save();
        $jumlah = $data['jumlah'];
        $subtotal = $produk->harga * $jumlah;

        $pembelian = $this->pembelian->find($data['pembelianID']);
        $pembelian->namaPelanggan = $data['member'];
        $pembelian->update();
        
        $detail = $this->detail;

        $detail->pembelianID = $data['pembelianID'];
        $detail->produkID = $produkID;
        $detail->jumlah = $jumlah;
        $detail->subtotal = $subtotal;
        
        $detail->save();
        $total = $this->detail->where('pembelianID', $data['pembelianID'])->sum('subtotal');
        $totalAkhir = $total;
        if ($data['member'] != 'Bukan member') {
            if ($total >= 100000){
                $potong = $total * 0.10;
                $totalAkhir = $total - $potong;
            }
            elseif ($total >= 50000){
                $potong = $total * 0.05;
                $totalAkhir = $total - $potong;
            }
        }

        $response = [
            'detailID' => $detail->detailID,
            'produk' => $detail->produk->namaProduk, // Example: Get product name via relationship
            'jumlah' => $detail->jumlah,
            'subtotal' => $detail->subtotal,
            'total' => $total,
            'totalAkhir' => $totalAkhir
        ];

        return response()->json($response);
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
        $pembelian = $this->pembelian->find($detail->pembelianID);
        $produk = $this->produk->find($detail->produkID);

        $int = (int)$detail->jumlah;
        $restok = $produk->stok + $int;
        $produk->stok = $restok;
        
        $produk->update();
        $detail->delete();
        $total = $this->detail->where('pembelianID', $detail->pembelianID)->sum('subtotal');
        $totalAkhir = $total;
        if ($pembelian->namaPelanggan != 'Bukan member') {
            if ($total >= 100000){
                $potong = $total * 0.10;
                $totalAkhir = $total - $potong;
            }
            elseif ($total >= 50000){
                $potong = $total * 0.05;
                $totalAkhir = $total - $potong;
            }
        }
        
        $response = [
            'total' => $total,
            'totalAkhir' => $totalAkhir
        ];

        return response()->json($response);
    }
}
