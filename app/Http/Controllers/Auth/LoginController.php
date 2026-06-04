<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $input = $request->input('nik');
        $password = $request->input('password');
        
        // Validasi input
        $request->validate([
            'nik' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cek user berdasarkan input (bisa NIP, NISN, atau NIK)
        $user = null;
        
        // Coba cari berdasarkan NIP (untuk admin dan guru)
        if (strlen($input) >= 8 && strlen($input) <= 20) {
            $user = \App\Models\User::where('nip', $input)->first();
        }
        
        // Jika tidak ketemu, coba cari berdasarkan NIK/NISN
        if (!$user) {
            $user = \App\Models\User::where('nik', $input)->first();
        }
        
        // Validasi panjang untuk siswa (NISN 10 digit)
        if ($user && $user->role === 'siswa' && strlen($input) !== 10) {
            return back()->withErrors(['nik' => 'NISN Atau Password Anda Salah Silahkan Coba Lagi'])->withInput();
        }
        
        // Jika tidak ketemu user
        if (!$user) {
            return back()->withErrors(['nik' => 'NISN Atau Password Anda Salah Silahkan Coba Lagi'])->withInput();
        }
        if ($user && !$user->is_active) {
            return back()->withErrors(['Akun Anda tidak aktif. Silakan hubungi admin.']);
        }
        
        // Cek verifikasi email untuk siswa
        if ($user && $user->role === 'siswa' && !$user->email_verified_at) {
            return back()->withErrors([
                'verifikasi' => 'Anda diwajibkan memasukan kode verifikasi terlebih dahulu sebelum login.'
            ])->withInput();
        }

        // Handle password dengan format yang sesuai database
        if ($user) {
            // Cek apakah password menggunakan hash atau plain text
            if (strlen($user->password) > 50) {
                // Password hashed, gunakan Hash::check
                if (\Hash::check($request->password, $user->password)) {
                    Auth::login($user);
                    $request->session()->regenerate();
                    
                    // Redirect berdasarkan role
                    if (Auth::user()->role === 'admin') {
                        return redirect()->intended('admin/dashboard');
                    } elseif (Auth::user()->role === 'guru') {
                        return redirect()->intended('guru/dashboard');
                    } elseif (Auth::user()->role === 'siswa') {
                        return redirect()->intended('siswa/dashboard');
                    } elseif (Auth::user()->role === 'orangtua') {
                        return redirect()->intended('orangtua/dashboard');
                    }
                    
                    return redirect()->intended('/dashboard');
                }
            } else {
                // Password plain text, gunakan direct comparison
                if ($request->password === $user->password) {
                    Auth::login($user);
                    $request->session()->regenerate();
                    
                    // Redirect berdasarkan role
                    if (Auth::user()->role === 'admin') {
                        return redirect()->intended('admin/dashboard');
                    } elseif (Auth::user()->role === 'guru') {
                        return redirect()->intended('guru/dashboard');
                    } elseif (Auth::user()->role === 'siswa') {
                        return redirect()->intended('siswa/dashboard');
                    } elseif (Auth::user()->role === 'orangtua') {
                        return redirect()->intended('orangtua/dashboard');
                    }
                    
                    return redirect()->intended('/dashboard');
                }
            }
        }

        return back()->withErrors([
            'nik' => ($user && ($user->role === 'admin' || $user->role === 'guru')) 
                ? 'NIP Atau Password Anda Salah Silahkan Cobah Lagi' 
                : 'NISN Atau Password Anda Salah Silahkan Coba Lagi',
        ])->onlyInput('nik');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}