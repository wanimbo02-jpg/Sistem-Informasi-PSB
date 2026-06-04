<?php

namespace App\Http\Controllers\Siswa\DataPribadi;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DataOrtuController extends Controller
{
    /**
     * Menampilkan form data orang tua
     */
    public function index()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();
        
        // Jika belum ada data pendaftaran, redirect ke halaman DATA PRIBADI
        // if (!$pendaftaran) {
        //     return redirect()->route('siswa.data-pribadi')
        //         ->with('error', 'Silakan isi data pribadi terlebih dahulu.');
        // }
        
        // PERBAIKAN: Sesuaikan path view dengan lokasi file Anda
        return view('siswa.data-pribadi.data-ortu', compact('pendaftaran'));
    }

    /**
     * Menyimpan data orang tua
     */
    public function store(Request $request)
    {
        // Trim semua input NIK
        $nikAyah = trim($request->nik_ayah ?? '');
        $nikIbu = trim($request->nik_ibu ?? '');
        $request->merge([
            'nik_ayah' => $nikAyah,
            'nik_ibu' => $nikIbu,
        ]);
        
        $validator = Validator::make($request->all(), [
            // Data Ayah
            'nama_ayah' => 'required|string|max:255',
            'nik_ayah' => 'required|string|size:16',
            'tanggal_lahir_ayah' => 'required|date',
            'pendidikan_ayah' => 'required|string',
            'pekerjaan_ayah' => 'required|string',
            'penghasilan_ayah' => 'required|string',
            
            // Data Ibu
            'nama_ibu' => 'required|string|max:255',
            'nik_ibu' => 'required|string|size:16',
            'tanggal_lahir_ibu' => 'required|date',
            'pendidikan_ibu' => 'required|string',
            'pekerjaan_ibu' => 'required|string',
            'penghasilan_ibu' => 'required|string',
            
            // Alamat dan Kontak
            'alamat_ortu' => 'required|string',
            'provinsi_ortu' => 'required|string',
            'kabupaten_ortu' => 'required|string',
            'kecamatan_ortu' => 'required|string',
            'kode_pos_ortu' => 'required|string|max:5',
            'no_hp_ortu' => 'required|string|max:13',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        
        // Update data pendaftaran
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();
        
        if (!$pendaftaran) {
            return redirect()->route('siswa.data-pribadi.index')
                ->with('error', 'Data pribadi tidak ditemukan. Silakan isi data pribadi terlebih dahulu.');
        }
        
        $pendaftaran->update($request->all());

        return redirect()->route('siswa.berkas.index')
            ->with('success', 'Data orang tua berhasil disimpan. Silakan upload berkas untuk melanjutkan.');
    }
}