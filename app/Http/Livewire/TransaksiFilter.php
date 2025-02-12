<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Transaksi;
use App\Models\Produk;

class TransaksiFilter extends Component
{
    use WithPagination;

    public $produkId;
    public $tanggal;
    public $search; // Properti untuk pencarian

    protected $queryString = ['produkId', 'tanggal', 'search'];
    public function resetFilters()
    {
        $this->produkId = null;
        $this->tanggal = null;
        $this->search = '';
    }
    
    // Fungsi untuk mendapatkan transaksi berdasarkan filter
    public function render()
    {
        $transaksi = Transaksi::query()
            ->when($this->search, function ($query) {
                return $query->whereHas('produk', function ($query) {
                    $query->where('nama_produk', 'like', '%' . $this->search . '%');
                })
                ->orWhere('keterangan', 'like', '%' . $this->search . '%');
            })
            ->when($this->tanggal, function ($query) {
                return $query->whereDate('tanggal_transaksi', $this->tanggal);
            })
            ->orderBy('tanggal_transaksi', 'desc')
            ->paginate(10);

        // Ambil produk untuk dropdown filter
        $produk = Produk::all();

        return view('livewire.transaksi-filter', compact('transaksi', 'produk'));
    }
}
