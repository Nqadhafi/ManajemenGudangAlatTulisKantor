<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::all();
        return view('admin.karyawan.index', compact('karyawan'));
    }
    
    public function create()
    {
        $divisi = Divisi::all();
        return view('admin.karyawan.create', compact('divisi'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:karyawan',
            'nama' => 'required',
            'nomor_hp' => 'required',
            'alamat' => 'required',
            'divisi_id' => 'required',
        ], [
            'nik.unique' => 'NIK sudah digunakan.'  // Pesan kustom
        ]);
    
        Karyawan::create($request->all());
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }
    
    public function edit($id)
    {
        $karyawan = Karyawan::find($id);
        $divisi = Divisi::all();
        return view('admin.karyawan.edit', compact('karyawan', 'divisi'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|unique:karyawan,nik,' . $id,
            'nama' => 'required',
            'nomor_hp' => 'required',
            'alamat' => 'required',
            'divisi_id' => 'required',
        ]);
    
        $karyawan = Karyawan::find($id);
        $karyawan->update([
            'nama' => $request->nama,
            'nomor_hp' => $request->nomor_hp,
            'alamat' => $request->alamat,
            'divisi_id' => $request->divisi_id,
        ]);
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diperbarui.');
    }
    
    public function destroy($id)
    {
        Karyawan::destroy($id);
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus.');
    }
    
}
