<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Produk;
use App\Models\Kategori;

class StockReport extends Component
{
    public $search = '';           // Untuk pencarian produk
    public $category_id = null;    // Untuk filter kategori
    // public $min_stock = null;      // Untuk filter stok minimal

    // Fungsi untuk merender data
    public function render()
    {
        $products = Produk::query()
            ->when($this->search, function ($query) {
                return $query->where('nama_produk', 'like', '%' . $this->search . '%');
            })
            ->when($this->category_id, function ($query) {
                return $query->where('kategori_id', $this->category_id);
            })
            // ->when($this->min_stock, function ($query) {
            //     return $query->where('stok', '>=', $this->min_stock);
            // })
            ->get(); // Mengambil semua produk yang sesuai filter

        $categories = Kategori::all(); // Menampilkan semua kategori untuk dropdown filter

        return view('livewire.stock-report', compact('products', 'categories'));
    }

    public function downloadPdf()
    {
        return redirect()->route('laporan.stok.pdf', [
            'search' => $this->search,
            'category_id' => $this->category_id
        ]);
    }
}

