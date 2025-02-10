<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Session;

class UserLoginController extends Controller
{
    // Menampilkan halaman login user
    public function index()
    {
        return view('login');  // Tampilkan view login
    }

    // Proses login user
    public function login(Request $request)
    {
        // Validasi NIK yang dimasukkan user
        $request->validate([
            'nik' => 'required|exists:karyawan,nik',  // Validasi agar NIK harus ada di database
        ]);

        // Cari data karyawan berdasarkan NIK
        $karyawan = Karyawan::where('nik', $request->nik)->first();
        
        if ($karyawan) {
            // Jika NIK ditemukan, simpan ke session
            session(['nik' => $karyawan->nik]);

            // Redirect ke halaman transaksi setelah login berhasil
            return redirect()->route('pengambilan.index');
        }

        // Jika NIK tidak ditemukan, kembali dengan error
        return back()->withErrors(['nik' => 'NIK tidak terdaftar']);
    }

    // Fitur logout user
    public function logout()
    {
        // Hapus session NIK saat logout
        session()->forget('nik');

        // Redirect ke halaman login
        return redirect('/');
    }
}
