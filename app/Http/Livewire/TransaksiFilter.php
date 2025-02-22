<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Transaksi;
use App\Models\Produk;
use Illuminate\Support\Facades\Route;

class TransaksiFilter extends Component
{
    use WithPagination;

    public $produkId;
    public $tanggal_awal;
    public $tanggal_akhir;
    public $search;
    public $jenis_transaksi;

    // Simpan filter dalam URL query string
    protected $queryString = ['produkId', 'tanggal_awal', 'tanggal_akhir', 'search', 'jenis_transaksi'];

    // Fungsi untuk mereset semua filter
    public function resetFilters()
    {
        $this->produkId = null;
        $this->tanggal_awal = null;
        $this->tanggal_akhir = null;
        $this->search = '';
    }

    // Fungsi yang dijalankan ketika komponen pertama kali dimuat
    public function mount()
    {
        // Cek jenis transaksi berdasarkan route
        if (Route::is('transaksi.masuk')) {
            $this->jenis_transaksi = 'masuk';
        } elseif (Route::is('transaksi.keluar')) {
            $this->jenis_transaksi = 'keluar';
        }
    }

    // Fungsi untuk mendapatkan transaksi berdasarkan filter
    public function render()
    {
        $transaksi = Transaksi::query()
            // Filter berdasarkan jenis transaksi (masuk/keluar)
            ->when($this->jenis_transaksi, function ($query) {
                return $query->where('jenis_transaksi', $this->jenis_transaksi);
            })
            // Filter berdasarkan pencarian produk atau keterangan
            ->when($this->search, function ($query) {
                return $query->where(function ($q) {
                    $q->whereHas('produk', function ($subQuery) {
                        $subQuery->where('nama_produk', 'like', '%' . $this->search . '%');
                    })
                    ->orWhere('keterangan', 'like', '%' . $this->search . '%');
                });
            })
            ->when(Route::is('transaksi.masuk'), function ($query) {
                return $query->where('jenis_transaksi', 'masuk');
            })
            ->when(Route::is('transaksi.keluar'), function ($query) {
                return $query->where('jenis_transaksi', 'keluar');
            })
            // Filter berdasarkan rentang tanggal
            ->when($this->tanggal_awal && $this->tanggal_akhir, function ($query) {
                return $query->whereBetween('tanggal_transaksi', [$this->tanggal_awal, $this->tanggal_akhir]);
            })
            ->orderBy('created_at', 'desc') // Urutkan berdasarkan tanggal terbaru
            ->paginate(10)
            ->withQueryString();

        // Ambil data produk untuk dropdown filter
        $produk = Produk::all();

        return view('livewire.transaksi-filter', compact('transaksi', 'produk'));
    }
}
