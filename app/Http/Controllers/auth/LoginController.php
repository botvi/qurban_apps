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
        
        // Coba login dengan username atau email
        $credentials = [
            'password' => $password
        ];
        
        // Jika input mengandung @, anggap sebagai email
        if (strpos($username, '@') !== false) {
            $credentials['email'] = $username;
        } else {
            $credentials['username'] = $username;
        }
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == 'superadmin') {
                Alert::success('Login Berhasil', 'Selamat datang kembali di E-Learning MTs Nurul Islam Gunung Toar.');
                return redirect()->route('dashboard-superadmin');
            } else if ($user->role == 'user') {
                Alert::success('Login Berhasil', 'Selamat datang di E-Learning MTs Nurul Islam Gunung Toar.');
                return redirect()->route('index');
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
        return redirect('/');
    }
}
