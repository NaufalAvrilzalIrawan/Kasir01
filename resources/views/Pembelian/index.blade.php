@extends('layouts.sidebar')
@section('content')
    <a href="/transaksi"><button type="button" class="btn btn-outline-primary">Trasaksi</button></a>
    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Petugas</th>
                    <th scope="col">Member</th>
                    <th scope="col">Produk</th>
                    <th scope="col">Total Akhir</th>
                    <th scope="col">Bayar</th>
                    <th scope="col">Kembalian</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembelians as $pembelian)    
                <tr class="">
                    <td scope="row">1</td>
                    <td>{{ $pembelian->tanggal }}</td>
                    <td>{{ $pembelian->user->nama }}</td>
                    <td>{{ $pembelian->namaPelanggan }}</td>
                    <td>
                        @foreach ($pembelian->detailPembelian as $detail)
                            {{ $detail->produk->namaProduk }} : {{ $detail->jumlah }} <br>
                        @endforeach
                    </td>
                    <td>{{ $pembelian->totalAkhir }}</td>
                    <td>{{ $pembelian->bayar }}</td>
                    <td>{{ $pembelian->kembalian }}</td>
                    <td><button type="button" class="btn btn-outline-primary">Button</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection