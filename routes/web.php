<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

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





Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Tambahkan route lainnya yang hanya bisa diakses oleh admin
    Route::resource('kategori', KategoriController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('karyawan', KaryawanController::class);
    Route::resource('divisi', DivisiController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('perusahaan', PerusahaanController::class);
});





Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::post('login', [LoginController::class, 'login'])->name('login.post');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\UserTransaksiController;

// Route untuk login user
Route::get('/', [UserLoginController::class, 'index'])->name('home');  // Halaman login user
Route::post('/user/login', [UserLoginController::class, 'login'])->name('user.login.submit');  // Proses login user

// Route untuk transaksi user setelah login
Route::get('/pengambilan', [UserTransaksiController::class, 'index'])->name('pengambilan.index');
Route::post('/pengambilan', [UserTransaksiController::class, 'store'])->name('pengambilan.store');

// Route untuk logout user
Route::post('/user/logout', [UserLoginController::class, 'logout'])->name('user.logout');
