<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\BarangController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LokasiController;
use App\Http\Controllers\Dashboard\PinjamanController;
use App\Http\Controllers\Dashboard\PinjamanBarangController;
use App\Http\Controllers\Dashboard\UserController;

use App\Http\Controllers\User\BarangController as UserBarangController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Http\Controllers\User\RiwayatPinjamanController as UserRiwayatPinjamanController;
use App\Http\Controllers\User\TroliController as UserTroliController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'store']);

Route::get('/', [UserBarangController::class, 'index']);
Route::get('barang/show/{id}', [UserBarangController::class, 'show']);
Route::get('troli', [UserTroliController::class, 'index']);
Route::get('troli/quick-add/{id}', [UserTroliController::class, 'quickStore']);
Route::get('troli/quick-delete/{id}', [UserTroliController::class, 'quickDestroy']);
Route::get('pinjaman/create', [UserRiwayatPinjamanController::class, 'create']);
Route::group(['middleware' => 'user_is_verified'], function () {
    Route::get('troli/next', [UserTroliController::class, 'next']);
    Route::post('troli/next', [UserTroliController::class, 'store']);
});
Route::group(['middleware' => 'auth'], function() {
    Route::get('profile', [UserProfileController::class, 'index']);
    Route::get('riwayat-pinjaman', [UserRiwayatPinjamanController::class, 'index']);
    Route::get('pinjaman/show/{id}', [UserRiwayatPinjamanController::class, 'show']);
    Route::get('logout', [AuthController::class, 'logout']);
});

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'is_admin']], function() {
    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/create', [AdminController::class, 'create']);
    Route::post('/admin/create', [AdminController::class, 'store']);
    Route::get('/admin/show/{id}', [AdminController::class, 'show']);
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('/admin/edit/{id}', [AdminController::class, 'update']);
    Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy']);

    Route::get('/barang', [BarangController::class, 'index']);
    Route::get('/barang/create', [BarangController::class, 'create']);
    Route::post('/barang/create', [BarangController::class, 'store']);
    Route::get('/barang/show/{id}', [BarangController::class, 'show']);
    Route::get('/barang/edit/{id}', [BarangController::class, 'edit']);
    Route::post('/barang/edit/{id}', [BarangController::class, 'update']);
    Route::post('/barang/edit/{id}/foto', [BarangController::class, 'fotoStore']);
    Route::delete('/barang/delete/{id}', [BarangController::class, 'destroy']);

    Route::get('/lokasi', [LokasiController::class, 'index']);
    Route::get('/lokasi/create', [LokasiController::class, 'create']);
    Route::post('/lokasi/create', [LokasiController::class, 'store']);
    Route::get('/lokasi/show/{id}', [LokasiController::class, 'show']);
    Route::get('/lokasi/edit/{id}', [LokasiController::class, 'edit']);
    Route::post('/lokasi/edit/{id}', [LokasiController::class, 'update']);
    Route::delete('/lokasi/delete/{id}', [LokasiController::class, 'destroy']);

    Route::get('/pinjaman', [PinjamanController::class, 'index']);
    Route::get('/pinjaman/create', [PinjamanController::class, 'create']);
    Route::post('/pinjaman/create', [PinjamanController::class, 'store']);
    Route::get('/pinjaman/show/{id}', [PinjamanController::class, 'show']);
    Route::get('/pinjaman/edit/{id}', [PinjamanController::class, 'edit']);
    Route::post('/pinjaman/edit/{id}', [PinjamanController::class, 'update']);
    Route::delete('/pinjaman/delete/{id}', [PinjamanController::class, 'destroy']);
    
    Route::post('/pinjaman-barang/create', [PinjamanBarangController::class, 'store']);
    Route::post('/pinjaman-barang/edit/{id}', [PinjamanBarangController::class, 'update']);
    Route::post('/pinjaman-barang/edit/{id}/konfirmasi-peminjaman', [PinjamanBarangController::class, 'konfirmasiPeminjaman']);
    Route::post('/pinjaman-barang/edit/{id}/tolak-peminjaman', [PinjamanBarangController::class, 'tolakPeminjaman']);
    Route::post('/pinjaman-barang/edit/{id}/konfirmasi-pengembalian', [PinjamanBarangController::class, 'konfirmasiPengembalian']);
    Route::delete('/pinjaman-barang/delete/{id}', [PinjamanBarangController::class, 'destroy']);

    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/show/{id}', [UserController::class, 'show']);
    Route::post('/user/edit/{id}/verifikasi', [UserController::class, 'verify']);
});