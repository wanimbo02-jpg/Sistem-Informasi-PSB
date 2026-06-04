<?php

namespace App\Http\Controllers;

use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\VerificationCodeMail;

class EmailVerificationController extends Controller
{
    /**
     * Show verification form
     */
    public function show()
    {
        $email = Session::get('verification_email');
        
        // Jika tidak ada session, tetap tampilkan form dengan input email
        if (!$email) {
            $email = '';
        }
        
        return view('auth.verify-email', compact('email'));
    }

    /**
     * Show verification form before login
     */
    public function showBeforeLogin()
    {
        $email = Session::get('verification_email');
        
        // Jika tidak ada session, tetap tampilkan form dengan input email
        if (!$email) {
            $email = '';
        }
        
        return view('auth.verify-before-login', compact('email'));
    }

    /**
     * Send verification code
     */
    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $email = $request->email;
        
        // Create verification code
        $verification = EmailVerification::createForEmail($email);
        
        // Send email
        try {
            Mail::to($email)->send(new VerificationCodeMail($verification->code));
            
            Session::put('verification_email', $email);
            
            return redirect('/verify-email')->with('success', 'Kode verifikasi telah dikirim ke email Anda.');
        } catch (\Exception $e) {
            Session::put('verification_email', $email);
            return redirect('/verify-email')->with('error', 'Gagal mengirim email. Pastikan email Anda benar dan coba lagi.');
        }
    }

    /**
     * Verify code
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        $email = Session::get('verification_email');
        
        if (!$email) {
            return redirect('/verify-email')->with('error', 'Sesi verifikasi telah berakhir. Silakan masukkan email Anda kembali.');
        }

        $verification = EmailVerification::findValid($email, $request->code);
        
        if (!$verification) {
            return back()->with('error', 'Kode verifikasi tidak valid atau telah kadaluarsa.');
        }

        // Mark as verified
        $verification->markAsVerified();
        
        // Activate user account
        $user = User::where('email', $email)->first();
        if ($user) {
            $user->email_verified_at = now();
            $user->save();
        }
        
        // Clear session
        Session::forget('verification_email');
        
        return redirect('/login')->with('success', 'Email berhasil diverifikasi! Silakan login.');
    }

    /**
     * Resend verification code
     */
    public function resend(Request $request)
    {
        $email = Session::get('verification_email');
        
        if (!$email) {
            return redirect('/register')->with('error', 'Sesi verifikasi telah berakhir. Silakan daftar ulang.');
        }

        // Create new verification code
        $verification = EmailVerification::createForEmail($email);
        
        // Send email
        try {
            Mail::to($email)->send(new VerificationCodeMail($verification->code));
            
            return back()->with('success', 'Kode verifikasi baru telah dikirim ke email Anda.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email. Pastikan email Anda benar dan coba lagi.');
        }
    }
}
