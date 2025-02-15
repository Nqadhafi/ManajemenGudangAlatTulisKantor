<?php
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\UserTransaksiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\StockReportController;
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
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Tambahkan route lainnya yang hanya bisa diakses oleh admin
    Route::resource('kategori', KategoriController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('karyawan', KaryawanController::class);
    Route::resource('divisi', DivisiController::class);
    Route::resource('perusahaan', PerusahaanController::class);
    Route::get('/laporan/stok', [StockReportController::class, 'index'])->name('laporan.stok');
    Route::get('/laporan/stok/pdf', [StockReportController::class, 'downloadPdf'])->name('laporan.stok.pdf');

Route::get('/transaksi/masuk', [TransaksiController::class, 'masuk'])->name('transaksi.masuk');
Route::get('/transaksi/keluar', [TransaksiController::class, 'keluar'])->name('transaksi.keluar');
Route::get('/transaksi/{jenis_transaksi}/create', [TransaksiController::class, 'create'])->name('transaksi.create');
Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
Route::get('/transaksi/{jenis_transaksi}/{transaksi}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit');
Route::put('/transaksi/{transaksi}', [TransaksiController::class, 'update'])->name('transaksi.update');
Route::delete('/transaksi/{transaksi}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
});





Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::post('login', [LoginController::class, 'login'])->name('login.post');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');



// Route untuk login user
Route::get('/', [UserLoginController::class, 'index'])->name('/');
Route::post('/user/login', [UserLoginController::class, 'login'])->name('user.login.submit');

// Route untuk transaksi user setelah login, menggunakan middleware check.logged.in
Route::middleware(['check.logged.in'])->group(function () {
    Route::get('/pengambilan', [UserTransaksiController::class, 'index'])->name('pengambilan.index');
    Route::post('/pengambilan', [UserTransaksiController::class, 'store'])->name('pengambilan.store');
    Route::get('/history', [UserTransaksiController::class, 'history'])->name('pengambilan.history');
});


// Route untuk logout user
Route::post('/user/logout', [UserLoginController::class, 'logout'])->name('user.logout');
