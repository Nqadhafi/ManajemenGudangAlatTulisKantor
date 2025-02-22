<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class UserTransaksiController extends Controller
{
    // Menampilkan halaman transaksi utama
    public function index()
    {
        Log::info("Memuat halaman pengambilan stok");

        // Pastikan user sudah login
        if (!session()->has('nik')) {
            return redirect()->route('pengambilan.index')->with('error', 'Anda harus login terlebih dahulu!');
        }

        // Ambil data karyawan berdasarkan NIK sesi
        $karyawan = Karyawan::where('nik', session('nik'))->first();

        // Ambil daftar produk yang tersedia untuk transaksi
        $produkList = Produk::orderBy('nama_produk','asc')
        ->get();

        return view('pengambilan.index', compact('karyawan', 'produkList'));
    }

    // Menampilkan riwayat transaksi user
    public function history()
    {
        Log::info("Memuat riwayat transaksi untuk NIK: " . session('nik'));

        // Ambil data transaksi berdasarkan user yang login
        $transaksi = Transaksi::where('nik_karyawan', session('nik'))
            ->orderBy('tanggal_transaksi', 'desc')
            ->get();

        return view('pengambilan.history', compact('transaksi'));
    }

    // Menangani penyimpanan transaksi baru
    public function store(Request $request)
    {
        Log::info("Menerima request transaksi", $request->all());

        // Pastikan user login sebelum transaksi
        if (!session()->has('nik')) {
            return redirect()->route('pengambilan.index')->with('error', 'Anda harus login untuk melakukan transaksi.');
        }

        // Validasi input
        $request->validate([
            'produk_id' => 'required|integer|exists:produk,id',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'required|string|max:255',
        ]);

        // Ambil produk
        $produk = Produk::find($request->produk_id);

        // Cek apakah stok cukup
        if ($produk->stok < $request->jumlah) {
            Log::error("Stok tidak mencukupi untuk produk: " . $produk->nama_produk);
            return redirect()->back()->with('error', 'Stok tidak mencukupi!');
        }

        // Buat transaksi
        Transaksi::create([
            'jenis_transaksi' => 'keluar',
            'produk_id' => $request->produk_id,
            'jumlah' => $request->jumlah,
            'tanggal_transaksi' => now(),
            'nik_karyawan' => session('nik'),
            'keterangan' => $request->keterangan,
        ]);

        // Kurangi stok produk
        $produk->stok -= $request->jumlah;
        $produk->save();

        return redirect()->route('pengambilan.index')->with('success', 'Transaksi berhasil!');
    }

    // Logout user
    public function logout()
    {
        Log::info("User logout: " . session('nik'));

        session()->forget('nik');
        return redirect()->route('pengambilan.index')->with('success', 'Anda telah logout.');
    }
}
