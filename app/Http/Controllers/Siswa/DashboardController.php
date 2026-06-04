<?php
// app/Http/Controllers/Siswa/DashboardController.php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Pengumuman;
use App\Models\Informasi;
use App\Models\Pengaturan;
use App\Models\SiswaDiterima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard siswa dengan data pendaftaran terbaru
     * dan informasi pendukung lainnya
     */
    public function index()
    {
        // Cek apakah user login sebagai siswa atau calon_mahasiswa
        if (Auth::check() && (Auth::user()->role == 'siswa' || Auth::user()->role == 'calon_mahasiswa')) {
            // Ambil data pendaftaran terakhir siswa yang login
            $pendaftaranTerakhir = Pendaftaran::where('user_id', Auth::id())
                ->with('berkas')
                ->latest()
                ->first();
                
            // Jika tidak ditemukan, coba cari berdasarkan NIS
            if (!$pendaftaranTerakhir && Auth::user()->nisn) {
                $pendaftaranTerakhir = Pendaftaran::where('nisn', Auth::user()->nisn)
                    ->with('berkas')
                    ->latest()
                    ->first();
            }
                
            // Ambil data siswa diterima berdasarkan user yang login
            $siswaDiterima = SiswaDiterima::whereHas('pendaftaran', function($query) {
                $query->where('user_id', Auth::id());
            })->with('pendaftaran')
                ->latest()
                ->first();
                
            // Jika tidak ditemukan, coba cari berdasarkan NIS
            if (!$siswaDiterima && Auth::user()->nisn) {
                $siswaDiterima = SiswaDiterima::whereHas('pendaftaran', function($query) {
                    $query->where('nisn', Auth::user()->nisn);
                })->with('pendaftaran')
                    ->latest()
                    ->first();
            }
        } else {
            // Fallback ke session untuk kompatibilitas ke belakang
            // Ambil data pendaftaran terakhir berdasarkan session atau cookie
            $pendaftaranTerakhir = null;
            
            if (Session::has('pendaftaran_id')) {
                $pendaftaranTerakhir = Pendaftaran::with('berkas')
                    ->where('id', Session::get('pendaftaran_id'))
                    ->first();
            }
            
            $siswaDiterima = null;
        }
        
        // Ambil pengumuman terbaru (fitur baru)
        $pengumuman = Pengumuman::where('aktif', true)
            ->latest()
            ->take(3)
            ->get();
        
        // Ambil pengumuman dari catatan_admin pendaftaran siswa
        $pengumumanSiswa = null;
        $seleksiAdminSiswa = null;
        
        if ($pendaftaranTerakhir && $pendaftaranTerakhir->catatan_admin) {
            // Cek apakah ini pesan tahap 1 atau tahap 2
            if (strpos($pendaftaranTerakhir->catatan_admin, 'Seleksi Administrasi') !== false && strpos($pendaftaranTerakhir->catatan_admin, 'FINAL') === false) {
                // Ini pesan tahap 1 untuk menu seleksi-administrasi
                $seleksiAdminSiswa = (object) [
                    'judul' => 'Hasil Seleksi Administrasi',
                    'isi' => $pendaftaranTerakhir->catatan_admin,
                    'created_at' => $pendaftaranTerakhir->updated_at,
                    'tipe' => 'seleksi_admin'
                ];
            } elseif (strpos($pendaftaranTerakhir->catatan_admin, 'FINAL') !== false) {
                // Ini pesan tahap 2 untuk menu pengumuman
                $pengumumanSiswa = (object) [
                    'judul' => 'Pengumuman Hasil Seleksi Final',
                    'isi' => $pendaftaranTerakhir->catatan_admin,
                    'created_at' => $pendaftaranTerakhir->updated_at,
                    'tipe' => 'seleksi_final'
                ];
            }
        }
        
        // Ambil informasi penting (fitur baru)
        $informasiPenting = Informasi::where('status', 'aktif')
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Ambil pengaturan jadwal ujian (fitur baru)
        $jadwalUjian = Pengaturan::where('key', 'jadwal_ujian')->first();
        
        // Cek apakah ada berkas yang diupload
        $berkas = null;
        if ($pendaftaranTerakhir && $pendaftaranTerakhir->berkas) {
            $berkas = $pendaftaranTerakhir->berkas;
        }
        
        return view('dashboard-siswa.indek', [
            'user' => Auth::user(),
            'pendaftaranTerakhir' => $pendaftaranTerakhir, 
            'pengumuman' => $pengumuman, 
            'pengumumanSiswa' => $pengumumanSiswa,
            'seleksiAdminSiswa' => $seleksiAdminSiswa,
            'informasiPenting' => $informasiPenting,
            'jadwalUjian' => $jadwalUjian,
            'data_pribadi' => $pendaftaranTerakhir ? true : false,
            'data_ortu' => $pendaftaranTerakhir ? true : false,
            'berkas' => $berkas,
            'progress' => ($pendaftaranTerakhir ? 1 : 0) + ($berkas ? 1 : 0),
            'progress_percent' => (($pendaftaranTerakhir ? 1 : 0) + ($berkas ? 1 : 0)) * 33.33,
            'siswaDiterima' => $siswaDiterima
        ]);
    }

    /**
     * Menampilkan detail pendaftaran siswa
     */
    public function show($id)
    {
        $pendaftaran = Pendaftaran::with('berkas')->findOrFail($id);
        
        // Validasi kepemilikan data untuk keamanan
        if (Auth::check() && (Auth::user()->role == 'siswa' || Auth::user()->role == 'calon_mahasiswa')) {
            // Cek apakah pendaftaran milik user yang login
            if ($pendaftaran->user_id != Auth::id()) {
                abort(403, 'Unauthorized access');
            }
        } else {
            // Fallback ke session validation
            if ($pendaftaran->id != Session::get('pendaftaran_id')) {
                abort(403, 'Unauthorized access');
            }
        }
        
        return view('siswa.pendaftaran.detail', compact('pendaftaran'));
    }

    /**
     * Menampilkan form cetak bukti pendaftaran
     */
    public function cetakBukti($id)
    {
        $pendaftaran = Pendaftaran::with('berkas')->findOrFail($id);
        
        // Validasi kepemilikan data untuk keamanan
        if (Auth::check() && (Auth::user()->role == 'siswa' || Auth::user()->role == 'calon_mahasiswa')) {
            // Cek apakah pendaftaran milik user yang login
            if ($pendaftaran->user_id != Auth::id()) {
                abort(403, 'Unauthorized access');
            }
        } else {
            // Fallback ke session validation
            if ($pendaftaran->id != Session::get('pendaftaran_id')) {
                abort(403, 'Unauthorized access');
            }
        }
        
        return view('siswa.pendaftaran.cetak', compact('pendaftaran'));
    }

    /**
     * Update profile siswa
     */
    public function updateProfile(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        
        // Validasi kepemilikan data
        if (Auth::check() && Auth::user()->role == 'siswa') {
            if ($pendaftaran->user_id != Auth::id()) {
                abort(403, 'Unauthorized access');
            }
        } else {
            if ($pendaftaran->id != Session::get('pendaftaran_id')) {
                abort(403, 'Unauthorized access');
            }
        }
        
        // Validasi input
        $request->validate([
            'handphone' => 'required|string|max:15',
            'email' => 'nullable|email',
            'alamat' => 'required|string',
            'nama_lengkap' => 'sometimes|required|string|max:255',
            'tempat_lahir' => 'sometimes|required|string|max:100',
            'tanggal_lahir' => 'sometimes|required|date',
        ]);
        
        // Siapkan data yang akan diupdate
        $updateData = [];
        
        if ($request->has('handphone')) {
            $updateData['handphone'] = $request->handphone;
        }
        
        if ($request->has('email')) {
            $updateData['email'] = $request->email;
        }
        
        if ($request->has('alamat')) {
            $updateData['alamat'] = $request->alamat;
        }
        
        // Tambahkan field tambahan jika ada
        $additionalFields = ['nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama'];
        foreach ($additionalFields as $field) {
            if ($request->has($field)) {
                $updateData[$field] = $request->$field;
            }
        }
        
        // Update data
        $pendaftaran->update($updateData);
        
        // Jika user terautentikasi, update juga data user jika diperlukan
        if (Auth::check() && (Auth::user()->role == 'siswa' || Auth::user()->role == 'calon_mahasiswa')) {
            if ($request->has('email')) {
                $user = Auth::user();
                $user->email = $request->email;
                $user->name = $request->nama_lengkap ?? $user->name;
                $user->save();
            }
        }
        
        return redirect()->back()->with('success', 'Profile berhasil diperbarui');
    }

    /**
     * Method tambahan untuk mengambil statistik pendaftaran (fitur baru)
     */
    public function getStatistik()
    {
        $totalPendaftar = Pendaftaran::count();
        $statusCounts = [
            'pending' => Pendaftaran::where('status', 'pending')->count(),
            'diterima' => Pendaftaran::where('status', 'diterima')->count(),
            'ditolak' => Pendaftaran::where('status', 'ditolak')->count(),
        ];
        
        return response()->json([
            'total' => $totalPendaftar,
            'status' => $statusCounts
        ]);
    }

    /**
     * Method untuk menyimpan session pendaftaran (untuk non-login flow)
     */
    public function setSessionPendaftaran(Request $request)
    {
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftarans,id'
        ]);
        
        Session::put('pendaftaran_id', $request->pendaftaran_id);
        
        return response()->json(['success' => true]);
    }

    /**
     * Method untuk membersihkan session pendaftaran
     */
    public function clearSessionPendaftaran()
    {
        Session::forget('pendaftaran_id');
        
        return response()->json(['success' => true]);
    }
}