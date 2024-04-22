<?php

namespace App\Http\Controllers;

use App\Models\DetailPembelian;
use App\Models\Member;
use App\Models\Pembelian;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PembelianController extends Controller
{
    public function __construct(protected Pembelian $pembelian, protected DetailPembelian $detail, protected Produk $produk, protected Member $member)
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

    public function transaksi() {
        $pembelian = $this->pembelian;
        $produk = $this->produk->get();

        return view('pembelian.transaksi', [
            'pembelian' => $pembelian,
            'produk' => $produk,
        ]);
    }
    public function create(Request $request)
    {
        $pembelian = $this->pembelian;
        $produk = $this->produk->get();
        $member = $this->member->get();
        $userID = Auth::id();

        $pembelian->userID = 1;
        $pembelian->tanggal = now('Asia/Jakarta');
        $tanggal = explode(' ', $pembelian->tanggal);

        $pembelian->save();

        return view('pembelian.transaksi', [
            'pembelian' => $pembelian,
            'produk' => $produk,
            'members' => $member,
            'tanggal' => $tanggal,
            'userID' => $userID
        ]);
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
    public function show($id)
    {
        $pembelian = $this->pembelian->with('user', 'detailPembelian')->find($id);
        if($pembelian == null) {
            return response()->json(['error'=>'tidak ada data']);
        }
        return response()->json($pembelian);
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
    public function update(Request $request, $id)
    {
        $pembelian = $this->pembelian->find($id);
        if ($pembelian == null) {
            return response()->json('data tidak ditemukan');
        }

        $data = $request->only([
            'total',
            'totalAkhir',
            'bayar',
            'kembalian'
        ]);

        $validator = Validator::make($data, [
            'namaPelanggan' => 'nullable|string',
            'total' => 'required|numeric',
            'totalAkhir' => 'required|numeric',
            'bayar' => 'required|numeric',
            'kembalian' => 'nullable|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $pembelian->total = $data['total'];
        $pembelian->totalAkhir = $data['totalAkhir'];
        $pembelian->bayar = $data['bayar'];
        $pembelian->kembalian = $data['kembalian'];

        $pembelian->update();

        return response()->json($pembelian);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pembelian = $this->pembelian->find($id);
        $pembelian->delete();
        return response()->json($pembelian);
    }
}
