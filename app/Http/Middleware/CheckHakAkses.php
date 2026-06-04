<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\HakAkses;
use Symfony\Component\HttpFoundation\Response;

class CheckHakAkses
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $modul): Response
    {
        // Cek apakah modul aktif
        if (!HakAkses::isModulAktif($modul)) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'message' => "Akses ke modul {$modul} sedang dinonaktifkan oleh admin.",
                    'status' => 'blocked'
                ], 403);
            }

            // Redirect ke halaman login dengan pesan yang sesuai
            if ($modul === 'guru') {
                return redirect()->route('login')
                    ->with('error', 'Akses Dashboard Guru sedang dinonaktifkan oleh admin. Silakan hubungi admin untuk mendapatkan izin akses.');
            } elseif ($modul === 'user') {
                return redirect()->route('login')
                    ->with('error', 'Pendaftaran siswa sedang ditutup. Silakan hubungi admin untuk informasi lebih lanjut.');
            }

            return redirect()->route('login')
                ->with('error', 'Akses modul ini sedang dinonaktifkan oleh admin.');
        }

        return $next($request);
    }
}
