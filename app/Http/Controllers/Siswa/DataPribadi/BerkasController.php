<?php

namespace App\Http\Controllers\Siswa\DataPribadi;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\BerkasPendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BerkasController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();
        $berkas = null;
        
        if ($pendaftaran) {
            $berkas = BerkasPendaftaran::where('pendaftaran_id', $pendaftaran->id)->first();
        }
        
        return view('siswa.data-pribadi.berkas', compact('pendaftaran', 'berkas'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();

        // Cek apakah ada pendaftaran
        if (!$pendaftaran) {
            return back()->with('error', 'Silakan lengkapi data pribadi dan data orang tua terlebih dahulu.');
        }

        $validator = Validator::make($request->all(), [
            'file_kk' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_ijazah' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_rapor' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_akte' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $berkasData = ['pendaftaran_id' => $pendaftaran->id];
        
        // Upload file_kk
        if ($request->hasFile('file_kk')) {
            $file = $request->file('file_kk');
            $filename = time() . '_kk_' . $pendaftaran->id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/berkas/kk', $filename, 'public');
            $berkasData['file_kk'] = $path;
        }

        // Upload file_ijazah
        if ($request->hasFile('file_ijazah')) {
            $file = $request->file('file_ijazah');
            $filename = time() . '_ijazah_' . $pendaftaran->id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/berkas/ijazah', $filename, 'public');
            $berkasData['file_ijazah'] = $path;
        }

        // Upload file_rapor
        if ($request->hasFile('file_rapor')) {
            $file = $request->file('file_rapor');
            $filename = time() . '_rapor_' . $pendaftaran->id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/berkas/rapor', $filename, 'public');
            $berkasData['file_rapor'] = $path;
        }

        // Upload file_akte
        if ($request->hasFile('file_akte')) {
            $file = $request->file('file_akte');
            $filename = time() . '_akte_' . $pendaftaran->id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/berkas/akte', $filename, 'public');
            $berkasData['file_akte'] = $path;
        }

        // Upload file_foto
        if ($request->hasFile('file_foto')) {
            $file = $request->file('file_foto');
            $filename = time() . '_foto_' . $pendaftaran->id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/berkas/foto', $filename, 'public');
            $berkasData['file_foto'] = $path;
        }

        // Upload file_daftar_kolektif (gunakan field file_foto)
        if ($request->hasFile('file_daftar_kolektif')) {
            $file = $request->file('file_daftar_kolektif');
            $filename = time() . '_daftar_kolektif_' . $pendaftaran->id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/berkas/daftar_kolektif', $filename, 'public');
            $berkasData['file_foto'] = $path; // Gunakan field file_foto yang sudah ada
        }

        // Upload file_surat_rekomendasi (gunakan field file_akte)
        if ($request->hasFile('file_surat_rekomendasi')) {
            $file = $request->file('file_surat_rekomendasi');
            $filename = time() . '_surat_rekomendasi_' . $pendaftaran->id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/berkas/surat_rekomendasi', $filename, 'public');
            $berkasData['file_akte'] = $path; // Gunakan field file_akte yang sudah ada
        }

        // Upload file_surat_keterangan (gunakan field file_rapor)
        if ($request->hasFile('file_surat_keterangan')) {
            $file = $request->file('file_surat_keterangan');
            $filename = time() . '_surat_keterangan_' . $pendaftaran->id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/berkas/surat_keterangan', $filename, 'public');
            $berkasData['file_rapor'] = $path; // Gunakan field file_rapor yang sudah ada
        }

        // Simpan atau update data berkas
        BerkasPendaftaran::updateOrCreate(
            ['pendaftaran_id' => $pendaftaran->id],
            $berkasData
        );

        return redirect()->route('siswa.selesai')
            ->with('success', 'Berkas berhasil diupload. Pendaftaran Anda telah selesai.');
    }
}