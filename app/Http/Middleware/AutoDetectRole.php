<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class AutoDetectRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Proses untuk login request
        if ($request->is('login') && $request->isMethod('POST')) {
            $username = $request->input('username');
            
            // Cek panjang username
            if (strlen($username) === 10) {
                // 10 angka = NISN, pastikan role siswa
                $user = User::where('nik', $username)->first();
                if ($user && $user->role !== 'siswa') {
                    return back()
                        ->withInput($request->only('username'))
                        ->withErrors([
                            'username' => 'silahkan masukkan nisn anda dengan benar'
                        ]);
                }
            } elseif (strlen($username) === 16) {
                // 16 angka = NIK, pastikan role admin/guru
                $user = User::where('nik', $username)->first();
                if ($user && in_array($user->role, ['siswa'])) {
                    return back()
                        ->withInput($request->only('username'))
                        ->withErrors([
                            'username' => 'silahkan masukkan nisn anda dengan benar'
                        ]);
                }
            }
        }

        // Proses untuk register request
        if ($request->is('register') && $request->isMethod('POST')) {
            $username = $request->input('username');
            
            // Tentukan role berdasarkan panjang username
            if (strlen($username) === 10) {
                // 10 angka = NISN, set role siswa
                $request->merge(['role' => 'siswa']);
            } elseif (strlen($username) === 16) {
                // 16 angka = NIK, set role guru (default untuk admin/guru)
                $request->merge(['role' => 'guru']);
            }
        }

        return $next($request);
    }
}
