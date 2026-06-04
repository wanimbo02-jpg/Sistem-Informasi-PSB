<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\BerkasPendaftaran;


class PendaftaranController extends Controller
{
    public function create()
    {
        return view('siswa.pendaftaran.formulir');
    }

    public function store(Request $request)
    {
        $request->validate([
            // Validasi Data Pribadi
            'id_pengguna' => 'required|string|max:50',
            'nisn' => 'required|string|size:10|unique:pendaftaran,nisn',
            'nik' => 'required|string|size:16|unique:pendaftaran,nik',
            'nama_lengkap' => 'required|string|max:255',
            'nama_panggilan' => 'nullable|string|max:100',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:50',
            'anak_ke' => 'nullable|integer|min:1',
            'jumlah_saudara' => 'nullable|integer|min:0',
            'alamat' => 'required|string',
            'rt_rw' => 'nullable|string|max:20',
            'kelurahan_desa' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kabupaten_kota' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'handphone' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'asal_sekolah' => 'required|string|max:255',
            'tahun_lulus' => 'required|integer|min:2000|max:' . date('Y'),
            
            // Validasi Data Pendaftaran
            'jalur_pendaftaran' => 'required|in:umum,prestasi,afirmasi,pindah_tugas',
            'jurusan1' => 'required|in:IPA,IPS,BAHASA',
            'jurusan2' => 'nullable|in:IPA,IPS,BAHASA',
            
            // Validasi Data Orang Tua
            'nama_ayah' => 'required|string|max:255',
            'nik_ayah' => 'nullable|string|size:16',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'pendidikan_ayah' => 'nullable|string|max:50',
            'penghasilan_ayah' => 'nullable|string|max:50',
            'telepon_ayah' => 'nullable|string|max:15',
            'nama_ibu' => 'required|string|max:255',
            'nik_ibu' => 'nullable|string|size:16',
            'pekerjaan_ibu' => 'nullable|string|max:255',
            'pendidikan_ibu' => 'nullable|string|max:50',
            'penghasilan_ibu' => 'nullable|string|max:50',
            'telepon_ibu' => 'nullable|string|max:15',
            'nama_wali' => 'nullable|string|max:255',
            'pekerjaan_wali' => 'nullable|string|max:255',
            'telepon_wali' => 'nullable|string|max:15',
            
            // Validasi File
            'file_ijazah' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_kk' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_akte' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_pas_foto' => 'required|file|mimes:jpg,jpeg,png|max:5120',
            'file_skhun' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_prestasi' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ], [
            'nisn.unique' => 'NISN sudah terdaftar',
            'nik.unique' => 'NIK sudah terdaftar',
            '*.required' => 'Field ini wajib diisi',
            '*.max' => 'Ukuran file maksimal 5MB',
            '*.mimes' => 'Format file harus PDF, JPG, JPEG, atau PNG'
        ]);

        // Simpan data pendaftaran
        $pendaftaran = Pendaftaran::create($request->except(['file_ijazah', 'file_kk', 'file_akte', 'file_pas_foto', 'file_skhun', 'file_prestasi']));

        // Upload dan simpan file
        $berkasData = [
            'pendaftaran_id' => $pendaftaran->id
        ];

        $fileFields = ['file_ijazah', 'file_kk', 'file_akte', 'file_pas_foto', 'file_skhun', 'file_prestasi'];
        
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . $pendaftaran->id . '_' . $field . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/berkas', $filename, 'public');
                $berkasData[$field] = $path;
            }
        }

        BerkasPendaftaran::create($berkasData);

        return redirect()->route('siswa.pendaftaran.sukses')
            ->with('success', 'Pendaftaran berhasil! Terima kasih telah mendaftar.');
    }

    public function sukses()
    {
        return view('siswa.pendaftaran.sukses');
    }
    
    public function index()
    {
        // Ini untuk halaman daftar pendaftaran
        $pendaftarans = collect([]); // Sementara kosong
        $isProfileComplete = true; // Sesuaikan dengan logic Anda
        
        return view('siswa.pendaftaran.index', compact('pendaftarans', 'isProfileComplete'));
    }
    
    /**
     * Menampilkan formulir pendaftaran
     */
    public function formulir()
    {
        return view('siswa.pendaftaran.formulir');
    }
}