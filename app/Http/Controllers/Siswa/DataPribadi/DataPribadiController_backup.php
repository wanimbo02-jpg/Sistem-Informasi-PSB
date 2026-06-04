<?php

namespace App\Http\Controllers\Siswa\DataPribadi;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Schema;

class DataPribadiController extends Controller
{
    /**
     * Menampilkan form data pribadi
     */
    public function index()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();
        
        return view('siswa.data-pribadi.data-pribadi', compact('user', 'pendaftaran'));
    }

    /**
     * Menyimpan data pribadi
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        // Validasi NIK dan Email HARUS sama dengan data user yang login
        $rules = [
            'nisn' => [
                'required',
                'numeric',
                'digits:10',
            ],
            'nik' => [
                'required',
                'numeric',
                'digits:16',
                // NIK harus sama dengan NIK user yang login
                function ($attribute, $value, $fail) use ($user) {
                    if ($value != $user->nik) {
                        $fail('NIK harus sama dengan NIK yang digunakan saat register.');
                    }
                },
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
            'kode_pos' => 'required|string|max:10',
            'handphone' => 'required|string|max:15',
            'asal_sekolah' => 'required|string|max:255',
            'tahun_lulus' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'tanggal_pendaftaran' => 'required|date|before_or_equal:today',
            // Domisili - Opsional
            'provinsi_domisili' => 'nullable|string|max:100',
            'kabupaten_domisili' => 'nullable|string|max:100',
            'nama_kabupaten_domisili' => 'nullable|string|max:100',
        ];

        // Validasi NISN - BOLEH SAMA (tidak perlu unique)
        // Hanya cek format saja

        $request->validate($rules);

        // Cek data berdasarkan user_id
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();
        
        if ($pendaftaran) {
            // UPDATE data yang sudah ada
            $pendaftaran->nisn = $request->nisn;
            $pendaftaran->nik = $user->nik;
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
            // Simpan domisili jika ada (opsional)
            $pendaftaran->provinsi_domisili = $request->provinsi_domisili;
            $pendaftaran->kabupaten_domisili = $request->kabupaten_domisili;
            $pendaftaran->nama_kabupaten_domisili = $request->nama_kabupaten_domisili;
            $pendaftaran->save();
        } else {
            // CREATE data baru
            $pendaftaran = new Pendaftaran();
            $pendaftaran->user_id = $user->id;
            $pendaftaran->nisn = $request->nisn;
            $pendaftaran->nik = $user->nik;
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
            // Simpan domisili jika ada (opsional)
            $pendaftaran->provinsi_domisili = $request->provinsi_domisili;
            $pendaftaran->kabupaten_domisili = $request->kabupaten_domisili;
            $pendaftaran->nama_kabupaten_domisili = $request->nama_kabupaten_domisili;
            $pendaftaran->save();
        }

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($pendaftaran->foto) {
                Storage::disk('public')->delete($pendaftaran->foto);
            }
            
            $fotoPath = $request->file('foto')->store('foto-siswa', 'public');
            $pendaftaran->foto = $fotoPath;
            $pendaftaran->save();
        }

        return redirect()->route('siswa.data-ortu.index')
            ->with('success', 'Data pribadi berhasil disimpan. Silakan lengkapi data orang tua.');
    }

    /**
     * Menampilkan data pribadi untuk diedit
     */
    public function edit()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();
        
        if (!$pendaftaran) {
            return redirect()->route('siswa.data-pribadi')
                ->with('error', 'Silakan isi data pribadi terlebih dahulu.');
        }
        
        return view('siswa.data-pribadi.edit', compact('user', 'pendaftaran'));
    }

    /**
     * Mengupdate data pribadi
     */
    public function update(Request $request)
    {
        return $this->store($request);
    }

    /**
     * Menghapus foto profil
     */
    public function deleteFoto()
    {
        $user = Auth::user();
        
        if ($user->foto) {
            Storage::disk('public')->delete($user->foto);
            $user->update(['foto' => null]);
            
            return response()->json(['success' => true, 'message' => 'Foto berhasil dihapus']);
        }
        
        return response()->json(['success' => false, 'message' => 'Tidak ada foto untuk dihapus']);
    }
}