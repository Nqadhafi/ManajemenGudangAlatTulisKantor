<?php
namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Transaksi;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserTransaksiController extends Controller
{
    // Menampilkan halaman transaksi
    public function index()
    {
        // Ambil produk yang tersedia untuk transaksi
        $produk = Produk::all();
    
        // Ambil data karyawan berdasarkan NIK yang ada di session
        $karyawan = Karyawan::where('nik', session('nik'))->first();
    
        // Kirim data produk dan karyawan ke view
        return view('pengambilan.index', compact('produk', 'karyawan'));
    }

    // Proses penyimpanan transaksi
    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|array',
            'jumlah' => 'required|array',
            'jumlah.*' => 'numeric|min:1', // Pastikan jumlah produk adalah angka dan lebih besar dari 0
        ]);
    
        foreach ($request->produk_id as $index => $produkId) {
            $produk = Produk::find($produkId);
    
            // Periksa jika stok produk mencukupi
            if ($produk->stok < $request->jumlah[$index]) {
                return redirect()->back()->with('error', 'Stok produk tidak mencukupi!');
            }
    
            // Jika stok cukup, buat transaksi
            Transaksi::create([
                'jenis_transaksi' => 'keluar', // Tipe transaksi keluar
                'produk_id' => $produkId,
                'jumlah' => $request->jumlah[$index],
                'tanggal_transaksi' => now(),
                'nik_karyawan' => session('nik'),
            ]);
    
            // Kurangi stok produk
            $produk->stok -= $request->jumlah[$index];
            $produk->save();
        }
    
        return redirect()->route('pengambilan.index')->with('success', 'Transaksi berhasil!');
    }
}

