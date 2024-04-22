@extends('layouts.sidebar')
@section('content')

<form class="row g-3 needs-validation" id="produkForm" novalidate>
  <div class="col-md-4">

    <label for="pembelianID" class="form-label">Pembelian</label>
    <input type="number" class="form-control" id="pembelianID" name="pembelianID" value="{{ $pembelian->pembelianID }}" readonly>
        
  </div>
  <div class="col-md-4">

    <label for="member" class="form-label">Member</label>
    <select class="form-select" id="member" name="member" required>
      <option value="Bukan member">Bukan member</option>
      @foreach ($members as $member)
        <option value="{{ $member->nama }}">{{ $member->nama }}</option>
      @endforeach
    </select>
        
  </div>
  <div class="col-md-4">

    <label for="tanggal" class="form-label">Tanggal</label>
    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $tanggal[0] }}" readonly>
        
  </div>

  <div class="col-md-4">

    <label for="produkID" class="form-label">Produk</label>
    <select class="form-select" id="produkID" name="produkID" required>
      @foreach ($produk as $prodk)
        <option value="{{ $prodk->produkID }}" data-harga="{{ $prodk->harga }}" data-stok="{{ $prodk->stok }}">{{ $prodk->namaProduk }}</option>
      @endforeach
    </select>

  </div>
  <div class="col-md-4">

    <label for="jumlah" class="form-label">Jumlah</label>
    <input type="number" class="form-control" id="jumlah" name="jumlah" required>
    
  </div>
  
  <div class="col-md-4">

    <label for="subtotal" class="form-label">Subtotal</label>
    <div class="input-group">
      <input type="number" class="form-control" id="subtotal" name="subtotal" readonly>
    </div>

  </div>
  <div class="col-md-4">
    <button class="btn btn-primary" type="submit" id="tambahBtn">Tambah</button>
  </div>

  
  <div class="col-12">

    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
      <label class="form-check-label" for="invalidCheck">
        Agree to terms and conditions
      </label>
    </div>

  </div>
</form>
<div class="table-responsive col-8">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Produk</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- data from ajax -->
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total</th>
                <th colspan="2" id="totalCol"></th>
            </tr>
        </tfoot>
    </table>
</div>
<form class="row" action="/pembelian/selesai{{ $pembelian->pembelianID }}" method="post" >
  @csrf
  <div class="col-md-4">
    <div class="card">
      <input type="hidden" class="form-control" id="total" name="total" readonly>
        <div class="card-body">
            <label for="totalAkhir" class="form-label">Total Akhir</label>
            <input type="number" class="form-control" id="totalAkhir" name="totalAkhir" readonly>
        </div>
    </div>
  </div>
  
  <div class="col-md-4">
      <div class="card">
          <div class="card-body">
              <label for="bayar" class="form-label">Bayar</label>
              <input type="number" class="form-control" id="bayar" name="bayar" required>
          </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card">
          <div class="card-body">
              <label for="kembalian" class="form-label">Kembalian</label>
              <input type="number" class="form-control" id="kembalian" name="kembalian" required>
              <button class="btn btn-success" type="submit" id="selesaiBtn" disabled>Selesai</button>
          </div>
      </div>
    </div>
  </form>
@php
var_dump($produk[0]->namaProduk);   
@endphp
<script src="assets/js/jquery-3.7.1.min.js"></script>
<script src="assets/js/subtotal.js"></script>
<script src="assets/js/tambahProduk.js"></script>
{{-- <script src="{{ asset('/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('js/subtotal.js') }}"></script> --}}
@endsection