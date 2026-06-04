<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\HakAkses;
use Symfony\Component\HttpFoundation\Response;

class CheckHakAksesRegister
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah modul user aktif
        if (!HakAkses::isModulAktif('user')) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'message' => "Pendaftaran siswa sedang ditutup oleh admin.",
                    'status' => 'blocked'
                ], 403);
            }

            // Redirect ke halaman login dengan pesan
            return redirect()->route('login')
                ->with('error', 'Pendaftaran siswa sedang ditutup. Silakan hubungi admin untuk informasi lebih lanjut.');
        }

        return $next($request);
    }
}
