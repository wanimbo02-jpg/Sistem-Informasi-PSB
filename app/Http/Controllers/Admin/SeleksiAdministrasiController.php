<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\SiswaDiterima;

class SeleksiAdministrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data siswa yang sudah diterima seleksi administrasi
        $pendaftarans = Pendaftaran::where('status_pendaftaran', 'diterima')
            ->orWhere('status', 'Anda_diterima_seleksi_administrasi')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.seleksi-administrasi.index', compact('pendaftarans'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('admin.seleksi-administrasi.show', compact('pendaftaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
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
        
        // Update status pendaftaran dan kelas
        $updateData = [
            'status' => $statusBaru,
            'updated_at' => now()
        ];
        
        // Tambahkan kelas jika ada
        if ($request->has('kelas') && $request->kelas) {
            $updateData['kelas'] = $request->kelas;
        }
        
        // Update data pendaftaran
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
        
        return redirect()->route('admin.seleksi-administrasi.index')
            ->with('success', 'Data siswa berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $pendaftaran = Pendaftaran::findOrFail($id);
            
            // Hapus data dari siswa_diterima jika ada
            $siswaDiterima = SiswaDiterima::where('pendaftaran_id', $pendaftaran->id)->first();
            if ($siswaDiterima) {
                $siswaDiterima->delete();
            }
            
            // Hapus data pendaftaran
            $pendaftaran->delete();
            
            return redirect()->route('admin.seleksi-administrasi.index')
                ->with('success', 'Data siswa berhasil dihapus!');
                
        } catch (\Exception $e) {
            return redirect()->route('admin.seleksi-administrasi.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
