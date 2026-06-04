<?php

namespace App\Http\Controllers\pendaftaran_siswa;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\EmailVerification;
use App\Mail\VerificationCodeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('pendaftaran-siswa.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'nik' => 'required|string|size:10|unique:users,nik',
            'password' => 'required|string|min:6|confirmed',
        ]);

        try {
            // Create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'nik' => $request->nik,
                'password' => Hash::make($request->password),
                'role' => 'siswa',
                'is_active' => 1,
            ]);

            // Create verification code
            $verification = EmailVerification::createForEmail($user->email);
            
            // Store email in session
            Session::put('verification_email', $user->email);
            Session::flash('success', 'Registrasi berhasil! Kode verifikasi telah dikirim ke email Anda.');

            // Send verification email
            try {
                Mail::to($user->email)->send(new VerificationCodeMail($verification->code));
            } catch (\Exception $e) {
                \Log::error('Email sending failed: ' . $e->getMessage());
                Session::flash('warning', 'Registrasi berhasil! Kode verifikasi telah dibuat. Silakan gunakan kode: ' . $verification->code);
            }

            return redirect()->route('verify.show');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Registrasi gagal. Silakan coba lagi.'])->withInput();
        }
    }

    public function showLoginForm()
    {
        return view('pendaftaran-siswa.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nik' => 'required|string',
            'password' => 'required|string',
        ]);

        // Find user
        $user = User::where('nik', $request->nik)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['nik' => 'NISN atau password salah']);
        }

        // Check email verification
        if ($user->role === 'siswa' && !$user->email_verified_at) {
            return back()->withErrors(['nik' => 'Email Anda belum diverifikasi. Silakan cek email Anda atau <a href="/verify-email">verifikasi sekarang</a>']);
        }

        if (!$user->is_active) {
            return back()->withErrors(['nik' => 'Akun Anda tidak aktif']);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended('/siswa/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}