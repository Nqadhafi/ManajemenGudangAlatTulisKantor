<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;


class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
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
            'stok' => 'required|numeric',
            'satuan' => 'required',
        ],[
            'nama_produk.unique' => 'Nama produk sudah ada. Mohon pilih nama lain.'  // Pesan kustom
        ]);
    
        Produk::create($request->all());
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
            'nama_produk' => 'required|unique:produk,nama_produk',
            'kategori_id' => 'required',
            'stok' => 'required|numeric',
            'satuan' => 'required',
        ], [
            'nama_produk.unique' => 'Masukan nama produk yang berbeda'  // Pesan kustom
        ]);
    
        $produk = Produk::find($id);
        $produk->update($request->all());
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }
    
    public function destroy($id)
    {
        Produk::destroy($id);
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
    
}
