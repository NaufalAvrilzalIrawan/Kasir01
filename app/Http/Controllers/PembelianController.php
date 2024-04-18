<?php

namespace App\Http\Controllers;

use App\Models\DetailPembelian;
use App\Models\Pembelian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PembelianController extends Controller
{
    public function __construct(protected Pembelian $pembelian, protected DetailPembelian $detail)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembelian = $this->pembelian->with('user','detailPembelian')->get();
        return response()->json($pembelian);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $pembelian = $this->pembelian;
        $userID = Auth::id();

        $pembelian->userID = $userID;
        $pembelian->tanggal = Carbon::now('Asia/Jakarta');

        $pembelian->save();
        return response()->json($pembelian);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $pembelian = $this->pembelian->find($id);
        $detail = $this->detail->where('pembelianID', $id)->get('subtotal');
        $total = $detail->sum('subtotal');
        if ($pembelian == null) {
            return response()->json('data tidak ditemukan');
        }

        $data = $request->only([
            'namaPelanggan',
        ]);

        $validator = Validator::make($data, [
            'namaPelanggan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $pembelian->namaPelanggan = $data['namaPelanggan'] ?? null;
        $pembelian->total = $total;
        dd($pembelian);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembelian $pembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembelian $pembelian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembelian $pembelian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembelian $pembelian)
    {
        //
    }
}
