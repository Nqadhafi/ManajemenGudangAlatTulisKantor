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
    public $tanggal;
    public $search;
    public $jenis_transaksi;

    // Memastikan filter disimpan dalam URL query string
    protected $queryString = ['produkId', 'tanggal', 'search', 'jenis_transaksi'];

    // Fungsi untuk mereset semua filter
    public function resetFilters()
    {
        $this->produkId = null;
        $this->tanggal = null;
        $this->search = '';
        $this->jenis_transaksi = null; // Reset filter jenis transaksi
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
            // Filter berdasarkan pencarian produk
            ->when($this->search, function ($query) {
                return $query->whereHas('produk', function ($query) {
                    $query->where('nama_produk', 'like', '%' . $this->search . '%');
                })
                ->orWhere('keterangan', 'like', '%' . $this->search . '%');
            })
            // Filter berdasarkan tanggal
            ->when($this->tanggal, function ($query) {
                return $query->whereDate('tanggal_transaksi', $this->tanggal);
            })
            // Urutkan berdasarkan tanggal transaksi (dari yang terbaru)
            ->orderBy('tanggal_transaksi', 'desc')
            ->paginate(10);

        // Ambil produk untuk dropdown filter
        $produk = Produk::all();

        return view('livewire.transaksi-filter', compact('transaksi', 'produk'));
    }
}
