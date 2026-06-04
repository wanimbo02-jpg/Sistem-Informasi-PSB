<?php

namespace App\Http\Controllers\Siswa\DataPribadi;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DataPendaftaranController extends Controller
{
    /**
     * Menampilkan form data pendaftaran
     */
    public function index()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();
        
        if (!$pendaftaran) {
            return redirect()->route('siswa.data-pribadi')
                ->with('error', 'Silakan isi data pribadi terlebih dahulu.');
        }
        
        return view('siswa.data-pendaftaran.index', compact('pendaftaran'));
    }

    /**
     * Menyimpan data pendaftaran
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jalur_pendaftaran' => 'required|in:umum,prestasi,afirmasi,pindah_tugas',
            'jurusan1' => 'required|in:IPA,IPS,BAHASA',
            'jurusan2' => 'nullable|in:IPA,IPS,BAHASA',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        
        // Update data pendaftaran
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();
        $pendaftaran->update([
            'jalur_pendaftaran' => $request->jalur_pendaftaran,
            'jurusan1' => $request->jurusan1,
            'jurusan2' => $request->jurusan2,
        ]);

        // Update progress user
        $user->progress_data = 50; // 50% setelah mengisi data pendaftaran
        $user->save();

        return redirect()->route('siswa.data-ortu')
            ->with('success', 'Data pendaftaran berhasil disimpan. Silakan lanjutkan ke data orang tua.');
    }
}