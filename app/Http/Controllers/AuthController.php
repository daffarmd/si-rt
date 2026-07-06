<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'role'     => 'required|in:admin,warga',
        ]);

        // Asumsi tabel users punya kolom: name (dipakai sbg username), password, role.
        // Sesuaikan field 'username' di bawah kalau kolom login kamu berbeda (mis. email).
        if (Auth::attempt(['name' => $credentials['username'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->route('dashboard.index')->with('success', 'Berhasil masuk aplikasi');
        }

        return back()->withErrors(['username' => 'Kombinasi nama pengguna / kata sandi salah.'])->onlyInput('username');
    }

    public function showRegister() {
        return view('auth.register');
    }

   public function storeRegister(Request $request) {
        $request->validate([
            'nik'      => 'required|string|max:20', 
            'username' => 'required|max:255|unique:users,name', 
            'password' => 'required|min:6|confirmed' 
        ], [
            'username.unique'    => 'Nama pengguna ini telah terdaftar di dalam sistem.',
            'password.confirmed' => 'Konfirmasi kata sandi baru Anda tidak cocok.'
        ]);

        // Simpan data pendaftar ke tabel users
        User::create([
            'name'     => $request->username, // Di database disimpan ke kolom 'name' sesuai logika login-mu
            'password' => Hash::make($request->password),
            'role'     => 'warga' // Setiap pendaftar mandiri otomatis diset sebagai warga biasa
            // 'nik'   => $request->nik, // Buka komen ini jika kamu menambahkan kolom 'nik' di tabel users
        ]);

        return redirect()->route('login')->with('success', 'Proses pendaftaran berhasil! Silakan masuk.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
