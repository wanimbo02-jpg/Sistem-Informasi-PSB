<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HakAkses;
use Illuminate\Http\Request;

class HakAksesController extends Controller
{
    public function index()
    {
        $hakAkses = HakAkses::all();
        
        // Pastikan ada data untuk user dan guru
        if ($hakAkses->where('nama_modul', 'user')->isEmpty()) {
            HakAkses::create([
                'nama_modul' => 'user',
                'status' => 'nonaktif',
                'keterangan' => 'Hak akses untuk login dan register siswa'
            ]);
        }
        
        if ($hakAkses->where('nama_modul', 'guru')->isEmpty()) {
            HakAkses::create([
                'nama_modul' => 'guru',
                'status' => 'nonaktif',
                'keterangan' => 'Hak akses untuk Dashboard Guru'
            ]);
        }
        
        $hakAkses = HakAkses::all();
        
        return view('admin.hak-akses.index', compact('hakAkses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:aktif,nonaktif',
            'keterangan' => 'nullable|string|max:255'
        ]);

        $hakAkses = HakAkses::findOrFail($id);
        $hakAkses->update($request->all());

        return redirect()->route('admin.hak-akses.index')
            ->with('success', 'Hak akses berhasil diperbarui!');
    }

    public function toggle($id)
    {
        $hakAkses = HakAkses::findOrFail($id);
        $statusBaru = $hakAkses->status === 'aktif' ? 'nonaktif' : 'aktif';
        $hakAkses->update(['status' => $statusBaru]);

        return redirect()->route('admin.hak-akses.index')
            ->with('success', "Hak akses {$hakAkses->nama_modul} berhasil di-" . $statusBaru . "kan!");
    }
}
