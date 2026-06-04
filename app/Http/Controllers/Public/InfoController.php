<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Informasi;

class InfoController extends Controller
{
    public function index()
    {
        // Ambil data informasi terbaru yang aktif dari database
        $informasi = Informasi::statusAktif()
            ->orderBy('created_at', 'desc')
            ->first();
        
        $dataInformasi = [];
        $jadwal = [];
        
        if ($informasi) {
            // Parse JSON data
            $dataInformasi = json_decode($informasi->konten, true);
            
            // Extract jadwal data jika ada
            if (isset($dataInformasi['jadwal']) && is_array($dataInformasi['jadwal'])) {
                foreach ($dataInformasi['jadwal'] as $item) {
                    $kegiatan = strtolower(str_replace(' ', '_', $item['kegiatan'] ?? ''));
                    $jadwal[$kegiatan] = $item['tanggal'] ?? '';
                }
            }
        }
        
        // Default jadwal jika tidak ada data
        $defaultJadwal = [
            'pendaftaran_online' => '1 Maret - 30 Juni 2024',
            'seleksi' => '1 Juli - 15 Juli 2024',
            'ujian_akan_dilaksanakan_pada' => '20 Juli 2024',
            'pengumuman' => '20 Juli 2024'
        ];
        
        // Merge dengan default
        $jadwal = array_merge($defaultJadwal, $jadwal);
        
        return view('Home.info', [
            'title' => 'Informasi PPDB',
            'informasi' => $informasi,
            'dataInformasi' => $dataInformasi,
            'jadwal' => $jadwal
        ]);
    }
}