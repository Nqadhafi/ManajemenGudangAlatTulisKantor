<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Produk;
use App\Models\Kategori;

class ProdukSearch extends Component
{
    use WithPagination;

    public $search = ''; // Untuk pencarian
    public $perPage = 10; // Jumlah produk per halaman

    protected $queryString = ['search']; // Simpan pencarian dalam URL

    public function updatingSearch()
    {
        $this->resetPage(); // Reset pagination ke halaman pertama saat melakukan pencarian
    }

    public function render()
    {
        $produk = Produk::query()
            ->when($this->search, function ($query) {
                return $query->where('nama_produk', 'like', '%' . $this->search . '%')
                             ->orWhereHas('kategori', function ($q) {
                                 $q->where('nama_kategori', 'like', '%' . $this->search . '%');
                             });
            })
            ->orderBy('nama_produk', 'asc')
            ->paginate($this->perPage);

        return view('livewire.produk-search', compact('produk'));
    }
}
