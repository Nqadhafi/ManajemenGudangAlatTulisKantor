<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function index()
    {
        $divisi = Divisi::all();
        return view('admin.divisi.index', compact('divisi'));
    }

    public function create()
    {
        return view('admin.divisi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_divisi' => 'required|unique:divisi,nama_divisi',
        ], [
            'nama_divisi.unique' => 'Nama Divisi sudah ada. Mohon pilih nama lain.'  // Pesan kustom
        ]);

        Divisi::create($request->all());
        return redirect()->route('divisi.index')->with('success', 'Divisi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $divisi = Divisi::find($id);
        return view('admin.divisi.edit', compact('divisi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_divisi' => 'required|unique:divisi,nama_divisi,'
        ], [
            'nama_divisi.unique' => 'Nama Divisi tidak boleh sama.' // Pesan kustom
        ]);

        $divisi = Divisi::find($id);
        $divisi->update($request->all());
        return redirect()->route('divisi.index')->with('success', 'Divisi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Divisi::destroy($id);
        return redirect()->route('divisi.index')->with('success', 'Divisi berhasil dihapus.');
    }
}
