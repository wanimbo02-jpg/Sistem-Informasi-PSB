<?php
namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\OrangTua;
use Illuminate\Support\Facades\Auth;

class DataController extends Controller
{
    public function dataPribadi()
    {
        $siswa = Siswa::where('user_id', Auth::id())->first();
        return view('siswa.data-pribadi', compact('siswa'));
    }
    
    public function storeDataPribadi(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        // Simpan data pribadi
        $siswa = Siswa::updateOrCreate(
            ['user_id' => Auth::id()],
            $request->all()
        );
        
        return redirect()->route('siswa.dashboard')->with('success', 'Data pribadi berhasil disimpan');
    }
    
    public function dataOrtu()
    {
        // Cek apakah sudah ada data siswa
        $siswa = Siswa::where('user_id', Auth::id())->first();
        if (!$siswa) {
            return redirect()->route('siswa.data-pribadi')->with('error', 'Isi data pribadi terlebih dahulu');
        }
        
        $ortu = OrangTua::where('siswa_id', $siswa->id)->first();
        return view('siswa.data-ortu', compact('ortu', 'siswa'));
    }
    
    public function storeDataOrtu(Request $request)
    {
        $siswa = Siswa::where('user_id', Auth::id())->first();
        
        // Validasi data orang tua
        $request->validate([
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'pekerjaan_ayah' => 'required',
            'pekerjaan_ibu' => 'required',
            'no_hp_ortu' => 'required',
            'alamat_ortu' => 'required',
        ]);

        // Simpan data orang tua
        $ortu = OrangTua::updateOrCreate(
            ['siswa_id' => $siswa->id],
            $request->all()
        );
        
        // Redirect ke halaman sukses
        return redirect()->route('pendaftaran.selesai');
    }
}