<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Login method
    public function login(Request $request)
    {
        // Validasi data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek kredensial login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect ke dashboard admin jika login sukses
            return redirect()->route('admin.dashboard');
        }

        // Jika gagal login
        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    // Logout method
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

