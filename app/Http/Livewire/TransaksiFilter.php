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

    protected $queryString = ['produkId', 'tanggal'];

    // Fungsi untuk mendapatkan transaksi berdasarkan filter
    public function render()
    {
        $transaksi = Transaksi::query()
            ->when($this->produkId, function ($query) {
                return $query->where('produk_id', $this->produkId);
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
