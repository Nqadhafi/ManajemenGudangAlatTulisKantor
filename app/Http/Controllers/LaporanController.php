<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function stok(Request $request)
    {
        // Ambil parameter filter dari request
        $kategoriId = $request->get('kategori_id');
        $produkId = $request->get('produk_id');
        
        // Query produk berdasarkan filter
        $produk = Produk::when($kategoriId, function ($query) use ($kategoriId) {
                        return $query->where('kategori_id', $kategoriId);
                    })
                    ->when($produkId, function ($query) use ($produkId) {
                        return $query->where('id', $produkId);
                    })
                    ->paginate(10);  // Pagination

        // Ambil data kategori untuk dropdown filter
        $kategori = Kategori::all();
        
        return view('admin.laporan.stok', compact('produk', 'kategori'));
    }

    public function transaksi(Request $request)
    {
        // Ambil parameter filter dari request
        $produkId = $request->get('produk_id');
        $jenisTransaksi = $request->get('jenis_transaksi');
        $tanggalMulai = $request->get('tanggal_mulai');
        $tanggalAkhir = $request->get('tanggal_akhir');
        
        // Query transaksi berdasarkan filter
        $transaksi = Transaksi::when($produkId, function ($query) use ($produkId) {
                        return $query->where('produk_id', $produkId);
                    })
                    ->when($jenisTransaksi, function ($query) use ($jenisTransaksi) {
                        return $query->where('jenis_transaksi', $jenisTransaksi);
                    })
                    ->when($tanggalMulai, function ($query) use ($tanggalMulai) {
                        return $query->whereDate('tanggal_transaksi', '>=', $tanggalMulai);
                    })
                    ->when($tanggalAkhir, function ($query) use ($tanggalAkhir) {
                        return $query->whereDate('tanggal_transaksi', '<=', $tanggalAkhir);
                    })
                    ->paginate(10); // Pagination

        // Ambil data produk untuk dropdown filter
        $produk = Produk::all();
        
        return view('admin.laporan.transaksi', compact('transaksi', 'produk'));
    }
}
