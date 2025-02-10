<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Produk;

class ProdukSearch extends Component
{
    public $search = '';
    public $produk_id = []; // Pastikan ini dideklarasikan sebagai array publik
    public $produk = [];

    // Method untuk memfilter produk berdasarkan pencarian
    public function updatedSearch()
    {
        $this->produk = Produk::where('nama_produk', 'like', '%' . $this->search . '%')->get();
    }

    public function render()
    {
        return view('livewire.produk-search');
    }
}
