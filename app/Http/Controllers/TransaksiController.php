<?php
namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Produk;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // Menampilkan transaksi masuk
    public function masuk(Request $request)
    {
        $transaksi = Transaksi::where('jenis_transaksi', 'masuk')->get();
        return view('admin.transaksi.index', compact('transaksi'));
    }

    // Menampilkan transaksi keluar
    public function keluar(Request $request)
    {
        $transaksi = Transaksi::where('jenis_transaksi', 'keluar')->get();
        return view('admin.transaksi.index', compact('transaksi'));
    }

    // Index - Menampilkan semua transaksi atau transaksi berdasarkan jenis
    public function index(Request $request)
    {
        $jenis = $request->query('jenis'); // Ambil query parameter 'jenis'
        
        if ($jenis) {
            $transaksi = Transaksi::where('jenis_transaksi', $jenis)->get();
        } else {
            $transaksi = Transaksi::all();
        }
    
        return view('admin.transaksi.index', compact('transaksi'));
    }

    // Menampilkan form untuk tambah transaksi (masuk/keluar)
    public function create($jenis_transaksi)
    {

        $produk = Produk::all();
        return view('admin.transaksi.create', compact('produk', 'jenis_transaksi'));
    }
    
    

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required',
            'jenis_transaksi' => 'required|in:masuk,keluar',
            'jumlah' => 'required|numeric|min:1',
            'tanggal_transaksi' => 'required|date',
        ]);
        
        // Ambil data produk
        $produk = Produk::findOrFail($request->produk_id);
    
        // Jika jenis transaksi "masuk", tambahkan stok
        if ($request->jenis_transaksi == 'masuk') {
            $produk->stok += $request->jumlah;
        }
        // Jika jenis transaksi "keluar", kurangi stok
        else if ($request->jenis_transaksi == 'keluar') {
            // Pastikan stok cukup untuk transaksi keluar
            if ($produk->stok >= $request->jumlah) {
                $produk->stok -= $request->jumlah;
            } else {
                return back()->withErrors(['error' => 'Stok tidak cukup untuk transaksi keluar.']);
            }
        }
    
        // Simpan perubahan stok
        $produk->save();
    
        // Simpan transaksi
        Transaksi::create([
            'produk_id' => $produk->id,
            'jumlah' => $request->jumlah,
            'jenis_transaksi' => $request->jenis_transaksi,
            'tanggal_transaksi' => $request->tanggal_transaksi,
        ]);
    
        // Redirect ke halaman transaksi sesuai dengan jenis transaksi yang dipilih
        if ($request->jenis_transaksi == 'masuk') {
            return redirect()->route('transaksi.masuk')->with('success', 'Transaksi masuk berhasil ditambahkan.');
        } else {
            return redirect()->route('transaksi.keluar')->with('success', 'Transaksi keluar berhasil ditambahkan.');
        }
    }
    

    // Menampilkan form untuk edit transaksi
    public function edit($jenis_transaksi, $id)
    {
        $transaksi = Transaksi::find($id);
        $produk = Produk::all();
        return view('admin.transaksi.edit', compact('transaksi', 'produk', 'jenis_transaksi'));
    }

    // Memperbarui transaksi yang sudah ada
    public function update(Request $request, $id)
    {
        $request->validate([
            'produk_id' => 'required',
            'jenis_transaksi' => 'required|in:masuk,keluar',
            'jumlah' => 'required|numeric|min:1',
            'tanggal_transaksi' => 'required|date',
        ]);
    
        $transaksi = Transaksi::findOrFail($id);
        $produk = Produk::findOrFail($transaksi->produk_id);
    
        // Mengembalikan stok ke kondisi sebelum transaksi diperbarui
        if ($transaksi->jenis_transaksi == 'masuk') {
            $produk->stok -= $transaksi->jumlah;
        } else {
            $produk->stok += $transaksi->jumlah;
        }
    
        // Validasi stok jika transaksi keluar
        if ($request->jenis_transaksi == 'keluar' && $produk->stok < $request->jumlah) {
            return back()->withErrors(['error' => 'Stok tidak cukup untuk transaksi keluar.']);
        }
    
        // Perbarui stok berdasarkan transaksi yang baru
        if ($request->jenis_transaksi == 'masuk') {
            $produk->stok += $request->jumlah;
        } else {
            $produk->stok -= $request->jumlah;
        }
    
        $produk->save();
    
        // Update transaksi
        $transaksi->update($request->all());

        if ($request->jenis_transaksi == 'masuk') {
            return redirect()->route('transaksi.masuk')->with('success', 'Transaksi masuk berhasil diedit.');
        } else {
            return redirect()->route('transaksi.keluar')->with('success', 'Transaksi keluar berhasil diedit.');
        }
    }

    // Menghapus transaksi
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $produk = Produk::findOrFail($transaksi->produk_id);
    
        // Kembalikan stok sebelum transaksi dihapus
        if ($transaksi->jenis_transaksi == 'masuk') {
            $produk->stok -= $transaksi->jumlah;
        } else {
            $produk->stok += $transaksi->jumlah;
        }
    
        $produk->save();
        $transaksi->delete();
    
        // Redirect ke halaman transaksi sesuai dengan jenis transaksi yang dihapus
        if ($transaksi->jenis_transaksi == 'masuk') {
            return redirect()->route('transaksi.masuk')->with('success', 'Transaksi masuk berhasil dihapus dan stok diperbarui.');
        } else {
            return redirect()->route('transaksi.keluar')->with('success', 'Transaksi keluar berhasil dihapus dan stok diperbarui.');
        }
    }
    
}
