<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Perusahaan;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $produkCount = Produk::count();
        $transaksiCount = Transaksi::count();
        $karyawanCount = Karyawan::count();
        $perusahaan = Perusahaan::first();
        
        // Ambil produk dengan stok rendah
        $produkRendah = Produk::where('stok', '<=', DB::raw('stok_minimum'))->get();
        $produkRendahCount = $produkRendah->count();
    
        
        return view('admin.dashboard', compact('produkCount', 'transaksiCount', 'karyawanCount', 'perusahaan', 'produkRendah', 'produkRendahCount'));
    }
    
    
}
