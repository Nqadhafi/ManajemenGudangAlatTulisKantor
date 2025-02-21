<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;


class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::paginate(10);
        return view('admin.produk.index', compact('produk'));
    }
    
    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.produk.create', compact('kategori'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|unique:produk,nama_produk',
            'kategori_id' => 'required',
            'satuan' => 'required',
            'stok_minimum' => 'required|numeric|min:0',
        ],[
            'nama_produk.unique' => 'Nama produk sudah ada. Mohon pilih nama lain.'  // Pesan kustom
        ]);
    
        Produk::create([
            'nama_produk' => $request->nama_produk,
            'kategori_id' => $request->kategori_id,
            'satuan' => $request->satuan,
            'stok' => 0,
            'stok_minimum' => $request->stok_minimum,
        ]);
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }
    
    public function edit($id)
    {
        $produk = Produk::find($id);
        $kategori = Kategori::all();
        return view('admin.produk.edit', compact('produk', 'kategori'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required',
            'kategori_id' => 'required',
            'satuan' => 'required',
            'stok_minimum' => 'required|numeric|min:0',
        ], [
            'nama_produk.unique' => 'Masukan nama produk yang berbeda'  // Pesan kustom
        ]);
    
        $produk = Produk::find($id);
        $produk->update($request->all());
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }
    
    public function destroy($id)
    {
        try {
            // Mencari produk berdasarkan id
            $produk = Produk::findOrFail($id);
            
            // Menghapus produk
            $produk->delete();
            
            return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
        } catch (QueryException $e) {
            // Jika terjadi error constraint violation (kode error 23000)
            if ($e->getCode() == 23000) {
                return back()->withErrors(['error' => 'Produk ini masih memiliki transaksi terkait dan tidak dapat dihapus.']);
            }
    
            // Menangani error lain yang mungkin terjadi
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus produk.']);
        }
    }
    
}
