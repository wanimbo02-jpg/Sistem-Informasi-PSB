<?php
// app/Http/Controllers/Guru/DashboardController.php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\User;
use App\Models\SiswaDiterima;
use App\Models\Kelas;
use App\Models\MataPelajaran;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua data pendaftaran dengan relasi user dan berkas (paginate 20 untuk tampilan tabel)
        $pendaftarans = Pendaftaran::with('user', 'berkas')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        // Hitung statistik untuk card
        $total = Pendaftaran::count();
        $pending = Pendaftaran::where('status', 'pending')->count();
        
        // Hitung verifikasi: data dengan status 'verifikasi'
        $verifikasi = Pendaftaran::where('status', 'verifikasi')->count();
        
        // Siswa yang sudah diseleksi administrasi (tahap pertama)
        $seleksiAdministrasi = Pendaftaran::where('status', 'Lulus seleksi administrasi')->count();
        
        // Siswa yang sudah diterima akhir (tahap akhir - dari tabel siswa_diterima)
        $diterimaAkhir = SiswaDiterima::where('status_seleksi', 'diterima')->count();
        
        // Siswa yang ditolak akhir
        $rejected = Pendaftaran::whereIn('status', ['ditolak', 'rejected', 'Tidak lulus seleksi administrasi'])->count();
        
        // Statistik gender (hitung dari database)
        $lakiCount = Pendaftaran::where('jenis_kelamin', 'L')->count();
        $perempuanCount = Pendaftaran::where('jenis_kelamin', 'P')->count();
        
        // Statistik jurusan (gunakan default karena kolom jurusan tidak ada)
        $ipaCount = 50; // Default value
        $ipsCount = 40; // Default value
        $bahasaCount = 30; // Default value
        
        // Statistik tambahan untuk view
        $hariIniCount = Pendaftaran::whereDate('created_at', today())->count();
        $bulanIniCount = Pendaftaran::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();
        $kelasCount = Kelas::count(); // Ambil dari database tabel kelas
        $mapelCount = MataPelajaran::count(); // Ambil dari database tabel mata_pelajaran
        $jadwalCount = 3; // Default value

        // Data untuk grafik berdasarkan database
        // Grafik per tahun (12 bulan)
        $tahunIni = date('Y');
        $grafikTahunan = [];
        for($i = 1; $i <= 12; $i++) {
            $count = Pendaftaran::whereYear('created_at', $tahunIni)
                                ->whereMonth('created_at', $i)
                                ->count();
            $grafikTahunan[] = $count;
        }

        // Grafik per bulan (4 minggu)
        $grafikMingguan = [];
        for($i = 3; $i >= 0; $i--) {
            $weekStart = now()->subWeeks($i)->startOfWeek();
            $weekEnd = now()->subWeeks($i)->endOfWeek();
            $count = Pendaftaran::whereBetween('created_at', [$weekStart, $weekEnd])->count();
            $grafikMingguan[] = $count;
        }

        // Grafik per tahun (5 tahun terakhir)
        $grafik5Tahun = [];
        for($i = 4; $i >= 0; $i--) {
            $year = date('Y') - $i;
            $count = Pendaftaran::whereYear('created_at', $year)->count();
            $grafik5Tahun[] = $count;
        }

        return view('guru.dashboard', compact(
            'pendaftarans',
            'total',
            'pending',
            'verifikasi',
            'seleksiAdministrasi',
            'diterimaAkhir',
            'rejected',
            'lakiCount',
            'perempuanCount',
            'ipaCount',
            'ipsCount',
            'bahasaCount',
            'hariIniCount',
            'bulanIniCount',
            'kelasCount',
            'mapelCount',
            'jadwalCount',
            'grafikTahunan',
            'grafikMingguan',
            'grafik5Tahun'
        ));
    }

    public function show($id)
    {
        $pendaftaran = Pendaftaran::with('user', 'berkas')->findOrFail($id);
        
        // Ambil data statistik untuk view
        $total = Pendaftaran::count();
        $pending = Pendaftaran::where('status', 'pending')->count();
        
        // Hitung verifikasi: data dengan status 'verifikasi'
        $verifikasi = Pendaftaran::where('status', 'verifikasi')->count();
        
        // Siswa yang sudah diseleksi administrasi (tahap pertama)
        $seleksiAdministrasi = Pendaftaran::where('status', 'Lulus seleksi administrasi')->count();
        
        // Siswa yang sudah diterima akhir (tahap akhir - dari tabel siswa_diterima)
        $diterimaAkhir = SiswaDiterima::where('status_seleksi', 'diterima')->count();
        
        // Siswa yang ditolak akhir
        $rejected = Pendaftaran::whereIn('status', ['ditolak', 'rejected', 'Tidak lulus seleksi administrasi'])->count();
        $pendaftarans = Pendaftaran::with('user', 'berkas')->orderBy('created_at', 'desc')->paginate(20);
        
        // Statistik jurusan (gunakan default karena kolom jurusan tidak ada)
        $ipaCount = 50; // Default value
        $ipsCount = 40; // Default value
        $bahasaCount = 30; // Default value
        
        // Statistik gender (hitung dari database)
        $lakiCount = Pendaftaran::where('jenis_kelamin', 'L')->count();
        $perempuanCount = Pendaftaran::where('jenis_kelamin', 'P')->count();
        
        return view('guru.Dashboard', compact('pendaftaran', 'total', 'pending', 'verifikasi', 'seleksiAdministrasi', 'diterimaAkhir', 'rejected', 'pendaftarans', 'ipaCount', 'ipsCount', 'bahasaCount', 'lakiCount', 'perempuanCount'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected,pending,diterima,ditolak,verifikasi'
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        
        // Konversi status ke format yang konsisten
        $status = $request->status;
        if ($status == 'accepted') $status = 'diterima';
        if ($status == 'rejected') $status = 'ditolak';
        
        $pendaftaran->status = $status;
        $pendaftaran->catatan_admin = $request->catatan_admin ?? $pendaftaran->catatan_admin;
        $pendaftaran->save();

        // Jika request AJAX, return JSON
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diperbarui'
            ]);
        }

        // Jika request biasa, redirect back
        return back()->with('success', 'Status berhasil diperbarui');
    }
}