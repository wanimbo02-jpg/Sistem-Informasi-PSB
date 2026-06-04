<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\SiswaDiterima;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SiswaDiseleksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswaDiterima = SiswaDiterima::orderBy('tanggal_diterima', 'desc')->paginate(10);
        
        return view('guru.siswa-diseleksi.index', compact('siswaDiterima'));
    }

    /**
     * Export data to different formats
     */
    public function export($format)
    {
        $siswaDiterima = SiswaDiterima::orderBy('tanggal_diterima', 'desc')->get();

        if ($format == 'excel') {
            $filename = 'siswa_diseleksi_' . date('Y-m-d_H-i-s') . '.csv';
            $data = [];
            $data[] = ['No', 'Nama Lengkap', 'NISN', 'Jenis Kelamin', 'Asal Sekolah', 'Tanggal Diterima', 'Status Seleksi'];
            foreach ($siswaDiterima as $index => $siswa) {
                $data[] = [
                    $index + 1,
                    $siswa->nama_lengkap ?? '-',
                    $siswa->nisn ?? '-',
                    $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
                    $siswa->asal_sekolah ?? '-',
                    isset($siswa->tanggal_diterima) ? $siswa->tanggal_diterima->format('d/m/Y') : '-',
                    ucfirst($siswa->status_seleksi ?? '-')
                ];
            }
            
            $csv_content = '';
            foreach ($data as $row) {
                $csv_content .= implode(',', $row) . "\n";
            }
            
            return response($csv_content)
                ->header('Content-Type', 'text/csv')
                ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
                
        } elseif ($format == 'pdf') {
            $filename = 'siswa_diseleksi_' . date('Y-m-d_H-i-s') . '.pdf';
            $pdf = Pdf::loadView('guru.siswa-diseleksi.export-pdf', compact('siswaDiterima'))
                ->setPaper('A4', 'landscape')
                ->setOptions([
                    'defaultFont' => 'Arial',
                    'isRemoteEnabled' => true,
                    'isHtml5ParserEnabled' => true,
                    'isFontSubsettingEnabled' => true,
                    'margin-left' => 8,
                    'margin-right' => 8,
                    'margin-top' => 15,
                    'margin-bottom' => 15,
                    'dpi' => 150,
                    'enable_php' => true,
                ]);
            return $pdf->download($filename);
            
        } elseif ($format == 'print') {
            return view('guru.siswa-diseleksi.export-print', compact('siswaDiterima'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
