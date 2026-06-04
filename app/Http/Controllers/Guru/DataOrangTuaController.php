<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class DataOrangTuaController extends Controller
{
    public function index()
    {
        // Ambil semua data pendaftaran dengan relasi user dan berkas
        $pendaftarans = Pendaftaran::with('user', 'berkas')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('guru.data-orang-tua.index', compact('pendaftarans'));
    }

    public function show($id)
    {
        // Ambil data pendaftaran lengkap dengan relasi
        $pendaftaran = Pendaftaran::with('user', 'berkas')->findOrFail($id);
        
        return view('guru.data-orang-tua.show', compact('pendaftaran'));
    }
}
