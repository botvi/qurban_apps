<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        $username = $request->username;
        $password = $request->password;
        
        $credentials = [
            'password' => $password
        ];
        
        if (strpos($username, '@') !== false) {
            $credentials['email'] = $username;
        } else {
            $credentials['username'] = $username;
        }
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                Alert::success('Login Berhasil', 'Selamat datang kembali di Panel Admin Tabungan Qurban.');
                return redirect()->route('dashboard');
            } else if ($user->role == 'pimpinan') {
                Alert::success('Login Berhasil', 'Selamat datang kembali di Panel Pimpinan Tabungan Qurban.');
                return redirect()->route('dashboard');
            } else {
                Auth::logout();
                Alert::error('Akses Ditolak', 'Anda tidak memiliki hak akses untuk masuk ke halaman ini.');
                return redirect('/login');
            }
        }
    
        Alert::error('Login Gagal', 'Username atau password yang Anda masukkan salah.');
        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Alert::success('Keluar Berhasil', 'Anda telah berhasil keluar dari sistem.');
        return redirect('/login');
    }
}
