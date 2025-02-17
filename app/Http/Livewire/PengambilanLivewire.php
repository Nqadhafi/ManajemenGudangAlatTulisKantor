<?php

namespace App\Http\Livewire;

use App\Models\Transaksi;
use Livewire\Component;
use App\Models\Produk;
use Illuminate\Support\Facades\Session;

class PengambilanLivewire extends Component
{
    public $produk_id;
    public $jumlah;
    public $keterangan;
    public $produkList = [];
    public $selectedProduk;
    public $stok;
    public $showModal = false;
    public $showSuccessModal = false;
    public $transaksiDetail = [];

    public function updatedProdukId()
    {
        // Ambil data produk yang dipilih
        $this->selectedProduk = Produk::find($this->produk_id);
        $this->stok = $this->selectedProduk ? $this->selectedProduk->stok : null;
    }

    public function confirmTransaksi()
    {
        // Validasi input sebelum mengirim ke controller
        $this->validate([
            'produk_id' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'keterangan' => 'required|string|max:255',
        ]);

        // Periksa stok
        if ($this->selectedProduk && $this->jumlah > $this->selectedProduk->stok) {
            session()->flash('error', 'Stok tidak mencukupi!');
            return;
        }

        // Simpan detail transaksi untuk modal sukses
        $this->transaksiDetail = [
            'nama' => $this->selectedProduk->nama_produk,
            'jumlah' => $this->jumlah,
            'keterangan' => $this->keterangan,
        ];

        // Tampilkan modal konfirmasi
        $this->emit('showModalKonfirmasi');
    }

    public function transaksiSukses()
    {
        // Simpan transaksi dan update stok produk
        $produk = Produk::find($this->produk_id);

        // Simpan transaksi
        Transaksi::create([
            'jenis_transaksi' => 'keluar',
            'produk_id' => $this->produk_id,
            'jumlah' => $this->jumlah,
            'tanggal_transaksi' => now(),
            'nik_karyawan' => session('nik'),
            'keterangan' => $this->keterangan,
        ]);

        // Kurangi stok produk
        $produk->stok -= $this->jumlah;
        $produk->save();

        // Reset form input setelah transaksi berhasil
        $this->reset(['produk_id', 'jumlah', 'keterangan', 'stok', 'selectedProduk']);

        // Perbarui daftar produk setelah transaksi berhasil
        $this->produkList = Produk::where('stok', '>', 0)->get();

        // Tampilkan modal sukses
        $this->showSuccessModal = true;
        $this->emit('showModalSukses');

        // Sembunyikan modal konfirmasi setelah transaksi sukses
        $this->emit('hideModals');
    }

    

    public function render()
    {
        return view('livewire.pengambilan-livewire');
    }
}
