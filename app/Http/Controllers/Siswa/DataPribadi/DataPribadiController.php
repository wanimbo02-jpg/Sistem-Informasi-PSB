<?php

namespace App\Http\Controllers\Siswa\DataPribadi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;

class DataPribadiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Cek data berdasarkan user_id
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();
        
        return view('siswa.data-pribadi.data-pribadi', compact('pendaftaran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        // Validasi Email HARUS sama dengan data user yang login
        $rules = [
            'nisn' => [
                'required',
                'numeric',
                'digits:10',
            ],
                        'email' => [
                'required',
                'email',
                // Email harus sama dengan email user yang login
                function ($attribute, $value, $fail) use ($user) {
                    if ($value != $user->email) {
                        $fail('Email harus sama dengan email yang digunakan saat register.');
                    }
                },
            ],
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:50',
            'alamat' => 'required|string',
            'kelurahan_desa' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kabupaten_kota' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'handphone' => 'required|string|max:15',
            'asal_sekolah' => 'required|string|max:255',
            'tahun_lulus' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'tanggal_pendaftaran' => 'nullable|date|before_or_equal:today',
            'nama_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'provinsi_domisili' => 'nullable|string|max:100',
            'kabupaten_domisili' => 'nullable|string|max:100',
            'nama_kabupaten_domisili' => 'nullable|string|max:100',
            // Field yang tidak ada di form di-comment dulu
            // 'jalur_pendaftaran' => 'nullable|in:umum,prestasi,afirmasi,pindah_tugas',
            // 'jurusan1' => 'nullable|in:IPA,IPS,BAHASA',
            // 'jurusan2' => 'nullable|in:IPA,IPS,BAHASA',
        ];

        // Validasi NISN - BOLEH SAMA (tidak perlu unique)
        // Hanya cek format saja

        $request->validate($rules);

        try {
            // Cek data berdasarkan user_id
            $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();
        
        if ($pendaftaran) {
            // UPDATE data yang sudah ada
            $pendaftaran->nisn = $request->nisn;
            $pendaftaran->nama_lengkap = $request->nama_lengkap;
            $pendaftaran->tempat_lahir = $request->tempat_lahir;
            $pendaftaran->tanggal_lahir = $request->tanggal_lahir;
            $pendaftaran->jenis_kelamin = $request->jenis_kelamin;
            $pendaftaran->agama = $request->agama;
            $pendaftaran->alamat = $request->alamat;
            $pendaftaran->kelurahan_desa = $request->kelurahan_desa;
            $pendaftaran->kecamatan = $request->kecamatan;
            $pendaftaran->kabupaten_kota = $request->kabupaten_kota;
            $pendaftaran->provinsi = $request->provinsi;
            $pendaftaran->kode_pos = $request->kode_pos;
            $pendaftaran->handphone = $request->handphone;
            $pendaftaran->email = $user->email;
            $pendaftaran->asal_sekolah = $request->asal_sekolah;
            $pendaftaran->tahun_lulus = $request->tahun_lulus;
            $pendaftaran->nama_ayah = $request->nama_ayah ?? '';
            $pendaftaran->nama_ibu = $request->nama_ibu ?? '';
            $pendaftaran->tanggal_pendaftaran = $request->tanggal_pendaftaran;
            // Handle upload foto
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/foto'), $filename);
                $pendaftaran->foto = $filename;
            }
            // Field domisili (opsional)
            $pendaftaran->provinsi_domisili = $request->provinsi_domisili;
            $pendaftaran->kabupaten_domisili = $request->kabupaten_domisili;
            $pendaftaran->nama_kabupaten_domisili = $request->nama_kabupaten_domisili;
            // Field pendaftaran yang tidak ada di form di-comment dulu
            // $pendaftaran->jalur_pendaftaran = $request->jalur_pendaftaran ?? 'umum';
            // $pendaftaran->jurusan1 = $request->jurusan1 ?? 'IPA';
            // $pendaftaran->jurusan2 = $request->jurusan2;
            // Set status default
            $pendaftaran->status = 'pending';
            $pendaftaran->save();
        } else {
            // CREATE data baru
            $pendaftaran = new Pendaftaran();
            $pendaftaran->user_id = $user->id;
            $pendaftaran->nisn = $request->nisn;
            $pendaftaran->nama_lengkap = $request->nama_lengkap;
            $pendaftaran->tempat_lahir = $request->tempat_lahir;
            $pendaftaran->tanggal_lahir = $request->tanggal_lahir;
            $pendaftaran->jenis_kelamin = $request->jenis_kelamin;
            $pendaftaran->agama = $request->agama;
            $pendaftaran->alamat = $request->alamat;
            $pendaftaran->kelurahan_desa = $request->kelurahan_desa;
            $pendaftaran->kecamatan = $request->kecamatan;
            $pendaftaran->kabupaten_kota = $request->kabupaten_kota;
            $pendaftaran->provinsi = $request->provinsi;
            $pendaftaran->kode_pos = $request->kode_pos;
            $pendaftaran->handphone = $request->handphone;
            $pendaftaran->email = $user->email;
            $pendaftaran->asal_sekolah = $request->asal_sekolah;
            $pendaftaran->tahun_lulus = $request->tahun_lulus;
            $pendaftaran->nama_ayah = $request->nama_ayah ?? '';
            $pendaftaran->nama_ibu = $request->nama_ibu ?? '';
            $pendaftaran->tanggal_pendaftaran = $request->tanggal_pendaftaran;
            // Handle upload foto
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/foto'), $filename);
                $pendaftaran->foto = $filename;
            }
            // Field domisili (opsional)
            $pendaftaran->provinsi_domisili = $request->provinsi_domisili;
            $pendaftaran->kabupaten_domisili = $request->kabupaten_domisili;
            $pendaftaran->nama_kabupaten_domisili = $request->nama_kabupaten_domisili;
            // Field pendaftaran yang tidak ada di form di-comment dulu
            // $pendaftaran->jalur_pendaftaran = $request->jalur_pendaftaran ?? 'umum';
            // $pendaftaran->jurusan1 = $request->jurusan1 ?? 'IPA';
            // $pendaftaran->jurusan2 = $request->jurusan2;
            // Set status default
            $pendaftaran->status = 'pending';
            $pendaftaran->save();
        }

        // Debug: Log sebelum redirect
        \Log::info('Akan redirect ke data-ortu.index untuk user: ' . $user->id);
        
        return redirect()->route('siswa.data-ortu.index')
                ->with('success', 'Data pribadi berhasil disimpan!');
        } catch (\Exception $e) {
            // Debug: Log error
            \Log::error('Error di DataPribadiController: ' . $e->getMessage());
            \Log::error('File: ' . $e->getFile() . ' Line: ' . $e->getLine());
            
            return redirect()->route('siswa.data-pribadi.index')
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
}
