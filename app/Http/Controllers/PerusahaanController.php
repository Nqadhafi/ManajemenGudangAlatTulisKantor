<?php

namespace App\Http\Controllers;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class PerusahaanController extends Controller
{

    public function index()
{
    $perusahaans = Perusahaan::all();
    return view('admin.perusahaan.index', compact('perusahaans'));
}

    public function create()
    {
        return view('admin.perusahaan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string|max:15',
        ]);

        // Handle file upload jika ada logo
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $logoPath;
        }

        Perusahaan::create($validated);
        return redirect()->route('perusahaan.index');
    }

    public function edit($id)
{
    $perusahaan = Perusahaan::findOrFail($id);
    return view('admin.perusahaan.edit', compact('perusahaan'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'alamat' => 'required|string',
        'nomor_telepon' => 'required|string|max:15',
    ]);

    $perusahaan = Perusahaan::findOrFail($id);

    if ($request->hasFile('logo')) {
        // Hapus logo lama
        if ($perusahaan->logo) {
            Storage::delete('public/' . $perusahaan->logo);
        }
        // Simpan logo baru
        $logoPath = $request->file('logo')->store('logos', 'public');
        $validated['logo'] = $logoPath;
    }

    $perusahaan->update($validated);
    return redirect()->route('perusahaan.index');
}
public function destroy($id)
    {
        // Mencari data perusahaan berdasarkan ID
        $perusahaan = Perusahaan::findOrFail($id);

        // Jika ada logo, hapus file logo dari storage
        if ($perusahaan->logo) {
            Storage::delete('public/' . $perusahaan->logo);
        }

        // Hapus data perusahaan
        $perusahaan->delete();

        // Redirect kembali ke halaman daftar perusahaan dengan pesan sukses
        return redirect()->route('perusahaan.index')->with('success', 'Data perusahaan berhasil dihapus.');
    }
}
