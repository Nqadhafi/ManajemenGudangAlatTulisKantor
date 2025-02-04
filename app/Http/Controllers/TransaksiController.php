<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Produk;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::all();
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
            'jumlah' => 'required|numeric',
            'tanggal_transaksi' => 'required|date',
        ]);

        Transaksi::create($request->all());
        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
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
        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Transaksi::destroy($id);
        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}

