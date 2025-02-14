<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use App\Models\Produk;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class StockReportController extends Controller
{
    public function index()
    {
        return view('admin.laporan.stok'); // Pastikan untuk merender view yang ada di folder admin
    }
    public function downloadPdf(Request $request)
    {
        // Ambil filter kategori dan pencarian dari request
        $category_id = $request->get('category_id');
        $search = $request->get('search');
        
        // Ambil data perusahaan
        $company = Perusahaan::first();

        // Ambil data produk berdasarkan filter (kategori dan pencarian)
        $products = Produk::query()
            ->when($search, function($query) use ($search) {
                return $query->where('nama_produk', 'like', '%' . $search . '%');
            })
            ->when($category_id, function($query) use ($category_id) {
                return $query->where('kategori_id', $category_id);
            })
            ->get();

        // Dapatkan waktu sekarang untuk prefix nama file
        $timestamp = now()->format('Y-m-d_His');
        $currentDateTime = now()->format('d-m-Y H:i:s');

        // Render PDF dengan data produk dan informasi perusahaan
        $pdf = PDF::loadView('admin.laporan.stok-pdf', compact('products', 'company','currentDateTime'));
        
        // Mengunduh PDF dengan nama file yang mengandung timestamp
        return $pdf->download("laporan_stok_atk&bahan_{$timestamp}.pdf");
    }
}
