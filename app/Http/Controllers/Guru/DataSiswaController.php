<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\SiswaDiterima;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class DataSiswaController extends Controller
{
    public function index()
    {
        // Ambil semua data pendaftaran dengan relasi user dan berkas
        $pendaftarans = Pendaftaran::with('user', 'berkas')
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('guru.data-siswa.index', compact('pendaftarans'));
    }

    public function show($id)
    {
        // Ambil data pendaftaran lengkap dengan relasi
        $pendaftaran = Pendaftaran::with('user', 'berkas')->findOrFail($id);
        
        return view('guru.data-siswa.show', compact('pendaftaran'));
    }

    
    public function edit($id)
    {
        // Ambil data pendaftaran untuk edit
        $pendaftaran = Pendaftaran::with('user', 'berkas')->findOrFail($id);
        
        return view('guru.data-siswa.edit', compact('pendaftaran'));
    }

    public function update(Request $request, $id)
    {
        // Update data pendaftaran
        $pendaftaran = Pendaftaran::findOrFail($id);
        
        // Validasi data
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nisn' => 'required|string|max:20',
            'jenis_kelamin' => 'required|in:L,P',
            'asal_sekolah' => 'required|string|max:255',
            'status' => 'required|in:pending,verifikasi,Lulus seleksi administrasi,Tidak lulus seleksi administrasi,diterima,ditolak',
            'kelas' => 'nullable|string|max:20'
        ]);

        $pendaftaran->update($validated);

        // Jika status diubah menjadi 'diterima', pindahkan ke database siswa_diterima
        if ($validated['status'] == 'diterima') {
            // Debug: Tampilkan data yang akan disimpan
            // dd($validated);
            $this->pindahkanKeSiswaDiterima($pendaftaran, $validated['kelas']);
        }

        // Jika status diubah menjadi 'verifikasi', update tahap 1 seleksi administrasi
        if ($validated['status'] == 'verifikasi') {
            $this->updateTahap1Seleksi($pendaftaran);
        }

        // Jika status diubah menjadi 'Lulus seleksi administrasi' atau 'Tidak lulus seleksi administrasi' dari menu Data Siswa, update tahap 1 seleksi administrasi
        if ($validated['status'] == 'Lulus seleksi administrasi' || $validated['status'] == 'Tidak lulus seleksi administrasi') {
            $this->updateTahap1Seleksi($pendaftaran, $validated['status']);
        }

        return redirect()->route('guru.data-siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Hapus data pendaftaran
        $pendaftaran = Pendaftaran::findOrFail($id);
        
        // Hapus juga data di siswa_diterima jika ada
        SiswaDiterima::where('pendaftaran_id', $pendaftaran->id)->delete();
        
        $namaSiswa = $pendaftaran->nama_lengkap; // Simpan nama untuk notifikasi
        $pendaftaran->delete();

        return redirect()->route('guru.data-siswa.index')
            ->with('success_hapus', 'Data siswa atas nama ' . $namaSiswa . ' berhasil dihapus!');
    }

    /**
     * Pindahkan data siswa yang diterima ke database siswa_diterima
     */
    private function pindahkanKeSiswaDiterima($pendaftaran, $kelas = null)
    {
        // Debug: Tampilkan data yang akan disimpan
        // dd([
        //     'pendaftaran_id' => $pendaftaran->id,
        //     'kelas' => $kelas,
        //     'nama_lengkap' => $pendaftaran->nama_lengkap
        // ]);
        
        // Cek apakah sudah ada di database
        $siswaDiterima = SiswaDiterima::where('pendaftaran_id', $pendaftaran->id)->first();
        
        if (!$siswaDiterima) {
            // Tambahkan data baru ke database
            SiswaDiterima::create([
                'pendaftaran_id' => $pendaftaran->id,
                'nama_lengkap' => $pendaftaran->nama_lengkap,
                'nisn' => $pendaftaran->nisn,
                'jenis_kelamin' => $pendaftaran->jenis_kelamin,
                'asal_sekolah' => $pendaftaran->asal_sekolah,
                'kelas' => $kelas, // Simpan kelas apa adanya
                'tanggal_diterima' => now()->format('Y-m-d'),
                'status_seleksi' => 'diterima'
            ]);
        } else {
            // Update data yang sudah ada - selalu update kelas
            $siswaDiterima->update([
                'kelas' => $kelas, // Update kelas
                'updated_at' => now()
            ]);
        }
    }

    /**
     * Menampilkan siswa yang sudah diseleksi
     */
    public function siswaDiseleksi()
    {
        // Ambil data siswa diterima dari database
        $siswaDiterima = SiswaDiterima::with('pendaftaran')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        // Debug: Tampilkan data untuk melihat kelas
        // dd($siswaDiterima->toArray());

        return view('guru.siswa-diseleksi.index', compact('siswaDiterima'));
    }

    /**
     * Menampilkan siswa yang diterima dalam seleksi administrasi
     */
    public function seleksiAdministrasi()
    {
        // Ambil data pendaftaran dengan status 'Lulus seleksi administrasi'
        $pendaftarans = Pendaftaran::with('user', 'berkas')
            ->where('status', 'Lulus seleksi administrasi')
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('guru.seleksi-administrasi.index', compact('pendaftarans'));
    }

    /**
     * Update data siswa yang sudah diseleksi
     */
    public function updateSiswaDiseleksi(Request $request, $id)
    {
        // Cari data pendaftaran dulu
        $pendaftaran = Pendaftaran::findOrFail($id);
        
        // Tentukan status baru untuk pendaftaran
        if ($request->status_seleksi == 'diterima') {
            $statusBaru = 'Lulus seleksi administrasi';
        } elseif ($request->status_seleksi == 'tidak_diterima') {
            $statusBaru = 'Tidak lulus seleksi administrasi';
        } else {
            $statusBaru = $pendaftaran->status;
        }
        
        // Update status pendaftaran dan kelas ke database
        $updateData = [
            'status' => $statusBaru,
            'updated_at' => now()
        ];
        
        // Tambahkan kelas jika ada
        if ($request->has('kelas') && $request->kelas) {
            $updateData['kelas'] = $request->kelas;
        }
        
        // Simpan perubahan status dan kelas ke tabel pendaftaran
        $pendaftaran->update($updateData);
        
        // Cari atau buat data di siswa_diterima
        $siswaDiterima = SiswaDiterima::where('pendaftaran_id', $pendaftaran->id)->first();
        
        if (!$siswaDiterima) {
            // Buat data baru di siswa_diterima
            SiswaDiterima::create([
                'pendaftaran_id' => $pendaftaran->id,
                'nama_lengkap' => $pendaftaran->nama_lengkap,
                'nisn' => $pendaftaran->nisn,
                'jenis_kelamin' => $pendaftaran->jenis_kelamin,
                'asal_sekolah' => $pendaftaran->asal_sekolah,
                'status_seleksi' => $request->status_seleksi,
                'tanggal_diterima' => now()->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } else {
            // Update data yang sudah ada
            $siswaDiterima->update([
                'status_seleksi' => $request->status_seleksi,
                'updated_at' => now()
            ]);
        }
        
        // Update dashboard siswa
        $this->updateDashboardSiswa($pendaftaran, $statusBaru);
        
        // Tentukan pesan notifikasi berdasarkan status
        $statusParam = '';
        $messageParam = '';
        
        if ($request->status_seleksi == 'diterima') {
            $statusParam = 'success_lulus';
            $messageParam = $pendaftaran->nama_lengkap . ' berhasil dinyatakan lulus';
        } elseif ($request->status_seleksi == 'tidak_diterima') {
            $statusParam = 'success_tidak_lulus';
            $messageParam = $pendaftaran->nama_lengkap . ' berhasil dinyatakan tidak lulus';
        }
        
        // Jika ada pemilihan kelas
        if ($request->has('kelas') && $request->kelas) {
            $statusParam = 'success_kelas';
            $messageParam = 'Kelas ' . $request->kelas . ' berhasil dipilih untuk ' . $pendaftaran->nama_lengkap . ' dan siswa dinyatakan lulus';
        }
        
        return redirect()->route('guru.seleksi-administrasi.index')
            ->with('success', 'Siswa berhasil diproses seleksi!')
            ->with('status', $statusParam)
            ->with('message', $messageParam);
    }

    
    /**
     * Update tahap 1 seleksi administrasi dari menu Data Siswa
     */
    private function updateTahap1Seleksi($pendaftaran, $status = null)
    {
        // Buat pesan untuk tahap 1 seleksi administrasi berdasarkan status
        if ($status == 'Lulus seleksi administrasi') {
            $pesanTahap1 = "Pengumuman Hasil Seleksi Administrasi\n\n" .
                           "Nama Siswa      : " . $pendaftaran->nama_lengkap . "\n" .
                           "NISN            : " . $pendaftaran->nisn . "\n\n" .
                           "STATUS\n" .
                           "Selamat! Anda DINYATAKAN LULUS seleksi administrasi.\n\n" .
                           "INFORMASI\n" .
                           "Silahkan menunggu informasi atau pengumuman tahap selanjutnya untuk mengikuti tes, pada waktu yang akan kami tentukan informasih ini akan kami informasihkan melalui web kami PPDB SMAN Karuba.\n\n" .
                           "Terima kasih.";
        } elseif ($status == 'Tidak lulus seleksi administrasi') {
            $pesanTahap1 = "Pengumuman Hasil Seleksi Administrasi\n\n" .
                           "Nama Siswa      : " . $pendaftaran->nama_lengkap . "\n" .
                           "NISN            : " . $pendaftaran->nisn . "\n\n" .
                           "STATUS\n" .
                           "Mohon maaf, Anda DINYATAKAN TIDAK LULUS seleksi administrasi.\n\n" .
                           "INFORMASI\n" .
                           "Terus berusaha dan jangan menyerah. Kami harap anda dapat mencoba lagi tahun depan.\n\n" .
                           "Terima kasih atas partisipasi Anda.";
        } else {
            // Default untuk status 'verifikasi'
            $pesanTahap1 = "Pengumuman Hasil Seleksi Administrasi\n\n" .
                           "Nama Siswa      : " . $pendaftaran->nama_lengkap . "\n" .
                           "NISN            : " . $pendaftaran->nisn . "\n\n" .
                           "STATUS\n" .
                           "Selamat! Anda LULUS seleksi administrasi.\n\n" .
                           "INFORMASI\n" .
                           "Silakan menunggu pengumuman hasil seleksi final di menu Pengumuman.\n\n" .
                           "Terima kasih.";
        }
        
        // Update catatan_admin untuk tahap 1
        $pendaftaran->update([
            'catatan_admin' => $pesanTahap1
        ]);
    }

    /**
     * Update dashboard siswa ketika status seleksi administrasi diubah
     */
    private function updateDashboardSiswa($pendaftaran, $status)
    {
        // Cari apakah sudah ada di database siswa_diterima
        $siswaDiterima = SiswaDiterima::where('pendaftaran_id', $pendaftaran->id)->first();
        
        if (!$siswaDiterima) {
            // Buat data baru di siswa_diterima
            SiswaDiterima::create([
                'pendaftaran_id' => $pendaftaran->id,
                'nama_lengkap' => $pendaftaran->nama_lengkap,
                'nisn' => $pendaftaran->nisn,
                'jenis_kelamin' => $pendaftaran->jenis_kelamin,
                'asal_sekolah' => $pendaftaran->asal_sekolah,
                'status_seleksi' => $status == 'Lulus seleksi administrasi' ? 'diterima' : 'tidak_diterima',
                'tanggal_diterima' => now()->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } else {
            // Update data yang sudah ada
            $siswaDiterima->update([
                'status_seleksi' => $status == 'Lulus seleksi administrasi' ? 'diterima' : 'tidak_diterima',
                'updated_at' => now()
            ]);
        }
        
        // Update pesan final pengumuman di dashboard siswa (tahap 2)
        if ($status == 'Lulus seleksi administrasi') {
            $kelasInfo = $pendaftaran->kelas ? "\nKelas           : " . $pendaftaran->kelas : "";
            $pesanFinal = "PENGUMUMAN HASIL SELEKSI FINAL\n\n" .
                          "Nama Siswa      : " . $pendaftaran->nama_lengkap . "\n" .
                          "NISN            : " . $pendaftaran->nisn .
                          $kelasInfo . "\n\n" .
                          "STATUS FINAL\n" .
                          "Selamat! Anda DITERIMA sebagai siswa SMAN Karubaga.\n\n" .
                          "INFORMASI PENTING\n" .
                          "Anda telah resmi diterima dan dimohon untuk mengikuti proses selanjutnya.\n\n" .
                          "Terima kasih dan selamat!";
        } else {
            $pesanFinal = "PENGUMUMAN HASIL SELEKSI FINAL\n\n" .
                          "Nama Siswa      : " . $pendaftaran->nama_lengkap . "\n" .
                          "NISN            : " . $pendaftaran->nisn . "\n\n" .
                          "STATUS FINAL\n" .
                          "Mohon maaf, anda TIDAK DITERIMA sebagai siswa SMAN Karubaga.\n\n" .
                          "INFORMASI\n" .
                          "Terus berusaha dan jangan menyerah. Kami harap anda dapat mencoba lagi tahun depan.\n\n" .
                          "Terima kasih atas partisipasi Anda.";
        }
        
        // Update catatan_admin untuk tahap 2 (final)
        $pendaftaran->update([
            'catatan_admin' => $pesanFinal
        ]);
    }

    /**
     * Hapus data siswa yang sudah diseleksi (dari seleksi administrasi)
     */
    public function destroySiswaDiseleksi($id)
    {
        // Cari pendaftaran di database
        $pendaftaran = Pendaftaran::findOrFail($id);
        $namaSiswa = $pendaftaran->nama_lengkap; // Simpan nama untuk notifikasi
        
        // Update status menjadi "Ditolak" agar tidak muncul di seleksi administrasi
        // tapi tetap ada di menu Data Siswa
        $pendaftaran->update([
            'status' => 'Ditolak'
        ]);

        return redirect()->route('guru.seleksi-administrasi.index')
            ->with('success_hapus', 'Data siswa atas nama ' . $namaSiswa . ' berhasil dihapus dari seleksi administrasi!');
    }

    /**
     * Update semua data siswa diterima ke halaman pengumuman user
     */
    public function updateAllToUser(Request $request)
    {
        if ($request->action == 'update_to_pengumuman') {
            // Ambil semua siswa diterima dari database
            $siswaDiterima = SiswaDiterima::with('pendaftaran')
                ->orderBy('tanggal_diterima', 'desc')
                ->get();
            
            // Convert ke array untuk cache
            $hasilSeleksi = [];
            foreach ($siswaDiterima as $siswa) {
                $pendaftaran = $siswa->pendaftaran;
                $tanggalDiterima = $siswa->tanggal_diterima;
                if ($tanggalDiterima) {
                    if (is_string($tanggalDiterima)) {
                        $tanggalDiterima = $tanggalDiterima;
                    } elseif (is_object($tanggalDiterima)) {
                        $tanggalDiterima = $tanggalDiterima->format('Y-m-d');
                    }
                } else {
                    $tanggalDiterima = now()->format('Y-m-d');
                }
                
                $hasilSeleksi[] = [
                    'id' => $siswa->id,
                    'pendaftaran_id' => $siswa->pendaftaran_id,
                    'nama_lengkap' => $siswa->nama_lengkap,
                    'nik' => $siswa->nik ?? ($pendaftaran ? $pendaftaran->nik : '-'),
                    'nisn' => $siswa->nisn,
                    'jenis_kelamin' => $siswa->jenis_kelamin,
                    'asal_sekolah' => $siswa->asal_sekolah,
                    'kelas' => $siswa->kelas,
                    'tanggal_diterima' => $tanggalDiterima,
                    'status_seleksi' => $siswa->status_seleksi
                ];
            }
            
            // Simpan ke cache untuk halaman user (pengumuman) - cache selama 24 jam
            \Cache::put('hasil_seleksi', $hasilSeleksi, now()->addHours(24));
            
            // Juga simpan ke session untuk backup
            session(['hasil_seleksi' => $hasilSeleksi]);
            
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate ke halaman Pengumuman!',
                'count' => count($hasilSeleksi)
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Aksi tidak valid!'
        ]);
    }

    /**
     * Export data siswa
     */
    public function export($format)
    {
        // Ambil semua data pendaftaran dengan relasi
        $pendaftarans = Pendaftaran::with(['user', 'berkas'])
            ->select('*')
            ->orderBy('created_at', 'desc')
            ->get();

        if ($format == 'excel') {
            // Export ke Excel
            $filename = 'data_siswa_' . date('Y-m-d_H-i-s') . '.csv';
            
            // Create array for Excel
            $data = [];
            $data[] = ['No', 'Nama Lengkap', 'NISN', 'Jenis Kelamin', 'Asal Sekolah', 'Email', 'No. HP', 'Status', 'Tanggal Daftar'];
            
            foreach ($pendaftarans as $index => $pendaftaran) {
                $data[] = [
                    $index + 1,
                    $pendaftaran->nama_lengkap ?? '-',
                    $pendaftaran->nisn ?? '-',
                    $pendaftaran->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
                    $pendaftaran->asal_sekolah ?? '-',
                    $pendaftaran->user->email ?? '-',
                    $pendaftaran->handphone ?? '-',
                    $this->getStatusText($pendaftaran->status),
                    isset($pendaftaran->created_at) ? $pendaftaran->created_at->format('d/m/Y H:i') : '-'
                ];
            }
            
            // Create CSV for Excel
            $csv = '';
            foreach ($data as $row) {
                $csv .= implode(',', array_map(function($field) {
                    return '"' . str_replace('"', '""', $field) . '"';
                }, $row)) . "\n";
            }
            
            return response($csv)
                ->header('Content-Type', 'text/csv')
                ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
        }
        elseif ($format == 'pdf') {
            // Export ke PDF
            $filename = 'data_siswa_' . date('Y-m-d_H-i-s') . '.pdf';
            
            try {
                $pdf = Pdf::loadView('guru.data-siswa.export-pdf', compact('pendaftarans'))
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
            } catch (\Exception $e) {
                // Fallback ke HTML jika PDF library tidak tersedia
                return response()->view('guru.data-siswa.export-pdf', compact('pendaftarans'))
                    ->header('Content-Type', 'text/html')
                    ->header('Content-Disposition', 'attachment; filename="' . $filename . '.html"');
            }
        }
        elseif ($format == 'print') {
            // Print view
            return view('guru.data-siswa.export-print', compact('pendaftarans'));
        }
        
        return redirect()->back()->with('error', 'Format export tidak valid!');
    }

    /**
     * Export siswa yang sudah diseleksi
     */
    public function exportSiswaDiseleksi($format)
    {
        $siswaDiterima = SiswaDiterima::orderBy('tanggal_diterima', 'desc')->get();

        if ($format == 'excel') {
            $filename = 'siswa_diseleksi_' . date('Y-m-d_H-i-s') . '.csv';
            $data = [];
            $data[] = ['No', 'Nama Lengkap', 'NISN', 'Jenis Kelamin', 'Asal Sekolah', 'Tanggal Diterima', 'Status Seleksi'];
            foreach ($siswaDiterima as $index => $siswa) {
                $tanggalDiterima = '-';
                if (!empty($siswa->tanggal_diterima)) {
                    if (is_string($siswa->tanggal_diterima)) {
                        $tanggalDiterima = \Carbon\Carbon::parse($siswa->tanggal_diterima)->format('d/m/Y');
                    } elseif (is_object($siswa->tanggal_diterima)) {
                        $tanggalDiterima = $siswa->tanggal_diterima->format('d/m/Y');
                    }
                }
                
                $data[] = [
                    $index + 1,
                    $siswa->nama_lengkap ?? '-',
                    $siswa->nisn ?? '-',
                    $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
                    $siswa->asal_sekolah ?? '-',
                    $tanggalDiterima,
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
        
        return redirect()->back()->with('error', 'Format export tidak valid!');
    }

    /**
     * Helper untuk status text
     */
    private function getStatusText($status)
    {
        $statusMap = [
            'pending' => 'Pending',
            'verifikasi' => 'Verifikasi',
            'Lulus seleksi administrasi' => 'Lulus Admin',
            'Tidak lulus seleksi administrasi' => 'Tidak Lulus Admin',
            'diterima' => 'Diterima',
            'ditolak' => 'Ditolak'
        ];
        
        return $statusMap[$status] ?? $status;
    }
}
