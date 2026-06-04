<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\OrangtuaWali;
use App\Models\Pendaftaran;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index()
    {
        // Status yang dianggap "lulus/diterima" — sesuai yang disimpan oleh Guru
        $statusLulus = 'Lulus seleksi administrasi';

        // Statistik
        $totalPendaftar = Pendaftaran::count();
        $siswaTerdaftar = Pendaftaran::where('status', $statusLulus)->count();
        $verifikasiPending = Pendaftaran::where('status', 'pending')
            ->orWhere('status', 'verifikasi')
            ->count();
        $diterima = Pendaftaran::where('status', $statusLulus)->count();

        // Statistik per jurusan (berdasarkan kelas yang dipilih guru)
        $ipaCount = 0;
        $ipsCount = 0;
        
        // Hitung IPA dari kelas-kelas IPA
        $ipaKelas = ['X IPA 1', 'XI IPA 2', 'XII IPA 3'];
        foreach ($ipaKelas as $kelas) {
            $ipaCount += Pendaftaran::where('status', $statusLulus)
                ->where('kelas', $kelas)
                ->count();
        }
        
        // Hitung IPS dari kelas-kelas IPS
        $ipsKelas = ['X IPS 1', 'XI IPS 2', 'XII IPS 3'];
        foreach ($ipsKelas as $kelas) {
            $ipsCount += Pendaftaran::where('status', $statusLulus)
                ->where('kelas', $kelas)
                ->count();
        }

        // Statistik per kelas (hanya yang status lulus seleksi administrasi)
        $kelasData = [];
        $kelasList = [
            'X IPA 1', 'XI IPA 2', 'XII IPA 3',
            'X IPS 1', 'XI IPS 2', 'XII IPS 3'
        ];
        
        foreach ($kelasList as $kelas) {
            $count = Pendaftaran::where('status', $statusLulus)
                ->where('kelas', $kelas)
                ->count();
            $kelasData[$kelas] = $count;
        }

        // Data grafik per bulan
        $monthlyData = [];
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        
        for ($i = 1; $i <= 12; $i++) {
            $count = Pendaftaran::whereMonth('created_at', $i)
                ->whereYear('created_at', date('Y'))
                ->count();
            $monthlyData[] = $count;
        }

        // Pendaftar terbaru
        $pendaftarTerbaru = Pendaftaran::with('berkas')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalPendaftar',
            'siswaTerdaftar',
            'verifikasiPending',
            'diterima',
            'ipaCount',
            'ipsCount',
            'kelasData',
            'pendaftarTerbaru',
            'monthlyData',
            'months'
        ));
    }
}