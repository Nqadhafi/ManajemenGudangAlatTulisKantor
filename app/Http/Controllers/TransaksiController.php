<?php
namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Produk;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
       // Hanya ambil transaksi dengan jenis 'masuk'
       $transaksi = Transaksi::where('jenis_transaksi', 'masuk')->get();
       return view('admin.transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $produk = Produk::all();
        return view('admin.transaksi.create', compact('produk'));
    }

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
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::find($id);
        $produk = Produk::all();
        return view('admin.transaksi.edit', compact('transaksi', 'produk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'produk_id' => 'required',
            'jenis_transaksi' => 'required|in:masuk,keluar',
            'jumlah' => 'required|numeric',
            'tanggal_transaksi' => 'required|date',
        ]);

        $transaksi = Transaksi::find($id);
        $transaksi->update($request->all());
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Transaksi::destroy($id);
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}

