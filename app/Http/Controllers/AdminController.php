<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Perusahaan;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $produkCount = Produk::count();
        $transaksiCount = Transaksi::count();
        $karyawanCount = Karyawan::count();
        $perusahaan = Perusahaan::first();
        return view('admin.dashboard', compact('produkCount', 'transaksiCount', 'karyawanCount', 'perusahaan'));
    }
    
}
