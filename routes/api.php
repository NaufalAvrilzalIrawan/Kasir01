<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DetailPembelianController;
use App\Http\Controllers\PembelianController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'index']);
    Route::post('/user/simpan', [UserController::class, 'store']);
    Route::get('/user{id}', [UserController::class, 'show']);
    Route::post('/user/ubah{id}', [UserController::class, 'update']);
    Route::get('/user/hapus{id}', [UserController::class, 'destroy']);
    Route::get('/logout', [UserController::class, 'logout']);

    Route::get('/produk', [ProdukController::class, 'index']);
    Route::post('/produk/simpan', [ProdukController::class, 'store']);
    Route::get('/produk{id}', [ProdukController::class, 'show']);
    Route::post('/produk/ubah{id}', [ProdukController::class, 'update']);
    Route::get('/produk/hapus{id}', [ProdukController::class, 'destroy']);

    Route::get('/member', [MemberController::class, 'index']);
    Route::post('/member/simpan', [MemberController::class, 'store']);
    Route::get('/member{id}', [MemberController::class, 'show']);
    Route::post('/member/ubah{id}', [MemberController::class, 'update']);
    Route::get('/member/hapus{id}', [MemberController::class, 'destroy']);

    Route::get('/detailpembelian', [DetailPembelianController::class, 'index']);
    Route::post('/detailpembelian/simpan', [DetailPembelianController::class, 'store']);
    Route::get('/detailpembelian{id}', [DetailPembelianController::class, 'show']);
    Route::post('/detailpembelian/ubah{id}', [DetailPembelianController::class, 'update']);
    Route::get('/detailpembelian/hapus{id}', [DetailPembelianController::class, 'destroy']);
});