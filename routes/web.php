<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Kategori
Route::resource('/admin/kategori', KategoriController::class);

// Produk
Route::resource('/admin/produk', ProdukController::class);

// Karyawan
Route::resource('/admin/karyawan', KaryawanController::class);

// Divisi
Route::resource('/admin/divisi', DivisiController::class);

// Transaksi
Route::resource('/admin/transaksi', TransaksiController::class);

// Perusahaan
Route::resource('/admin/perusahaan', PerusahaanController::class);

