<?php

use App\Http\Controllers\PembelianController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DetailPembelianController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/coba', function () {
    return view('dashboard');
});
Route::get('/detailpembelian', [DetailPembelianController::class, 'index']);
Route::post('/detailpembelian/simpan', [DetailPembelianController::class, 'store']);
Route::get('/detailpembelian{id}', [DetailPembelianController::class, 'show']);
Route::post('/detailpembelian/ubah{id}', [DetailPembelianController::class, 'update']);
Route::get('/detailpembelian/hapus{id}', [DetailPembelianController::class, 'destroy']);

Route::get('/pembelian', [PembelianController::class, 'index']);
Route::get('/transaksi', [PembelianController::class, 'create']);
Route::post('/pembelian/siap', [PembelianController::class, 'create']);
Route::post('/pembelian/simpan{id}', [PembelianController::class, 'store']);
Route::get('/pembelian{id}', [PembelianController::class, 'show']);
Route::post('/pembelian/ubah{id}', [PembelianController::class, 'update']);
Route::get('/pembelian/hapus{id}', [PembelianController::class, 'destroy']);