<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Selamat Datang',
            'tahun_ajaran' => '2024/2025'
        ];
        
        return view('home.index', $data);
    }

    /**
     * Menampilkan semua pengumuman
     */
    public function pengumumanIndex()
    {
        // Untuk sementara, data pengumuman dihardcode
        $pengumuman = [
            (object) [
                'judul' => 'Pengumuman Hasil Seleksi PPDB',
                'isi' => 'Hasil seleksi pendaftaran siswa baru telah dirilis. Silakan cek menu "Hasil Seleksi" untuk melihat daftar siswa yang diterima.',
                'created_at' => now()
            ]
        ];
        
        return view('pengumuman.index', compact('pengumuman'));
    }

    /**
     * Menampilkan hasil seleksi
     */
    public function hasilSeleksi()
    {
        // Ambil data hasil seleksi dari cache (dulu dari session)
        $hasilSeleksi = \Cache::get('hasil_seleksi', session('hasil_seleksi', []));
        
        // Ambil data pengumuman aktif dari database berdasarkan jenis
        $pengumumanSeleksi = \App\Models\Pengumuman::where('jenis_pengumuman', 'seleksi_administrasi')->where('aktif', true)->orderBy('created_at', 'desc')->first();
        $pengumumanFinal = \App\Models\Pengumuman::where('jenis_pengumuman', 'pengumuman_final')->where('aktif', true)->orderBy('created_at', 'desc')->first();
        
        return view('pengumuman.hasil-seleksi', compact('hasilSeleksi', 'pengumumanSeleksi', 'pengumumanFinal'));
    }

    /**
     * Download hasil seleksi PDF
     */
    public function downloadPDF()
    {
        $hasilSeleksi = \Cache::get('hasil_seleksi', session('hasil_seleksi', []));
        
        // Generate PDF (gunakan library seperti DomPDF)
        // Untuk sekarang, return view dulu
        return view('pengumuman.pdf', compact('hasilSeleksi'));
    }

    /**
     * Download hasil seleksi Word
     */
    public function downloadWord()
    {
        $hasilSeleksi = \Cache::get('hasil_seleksi', session('hasil_seleksi', []));
        
        // Generate Word (gunakan library seperti PHPWord)
        // Untuk sekarang, return view dulu
        return view('pengumuman.word', compact('hasilSeleksi'));
    }

    /**
     * Download hasil seleksi Excel
     */
    public function downloadExcel()
    {
        $hasilSeleksi = \Cache::get('hasil_seleksi', session('hasil_seleksi', []));
        
        // Generate Excel (gunakan library seperti Laravel Excel)
        // Untuk sekarang, return view dulu
        return view('pengumuman.excel', compact('hasilSeleksi'));
    }
}
