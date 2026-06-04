<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class DataMataPelajaranController extends Controller
{
    public function index()
    {
        $dataMapel = MataPelajaran::orderBy('nama_mapel')->paginate(10);
        
        // Statistik
        $totalMapel = MataPelajaran::count();
        $mapelAktif = MataPelajaran::where('status', 'aktif')->count();
        $mapelTidakAktif = MataPelajaran::where('status', 'tidak aktif')->count();

        return view('guru.data-mata-pelajaran.index', compact(
            'dataMapel',
            'totalMapel',
            'mapelAktif',
            'mapelTidakAktif'
        ));
    }

    public function create()
    {
        return view('guru.data-mata-pelajaran.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_mapel' => 'required|string|max:100|unique:mata_pelajaran,nama_mapel',
            'code_mapel' => 'required|string|max:20|unique:mata_pelajaran,code_mapel',
            'nama_pengajar' => 'required|string|max:100',
            'nip_pengajar' => 'required|string|max:30|unique:mata_pelajaran,nip_pengajar',
            'foto_pengajar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:aktif,tidak aktif'
        ]);

        // Handle file upload
        if ($request->hasFile('foto_pengajar')) {
            $file = $request->file('foto_pengajar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/foto-pengajar'), $filename);
            $validated['foto_pengajar'] = $filename;
        }

        MataPelajaran::create($validated);

        return redirect()->route('guru.data-mata-pelajaran.index')->with('success', 'Data mata pelajaran berhasil ditambahkan');
    }

    public function show($id)
    {
        $mapel = MataPelajaran::findOrFail($id);
        return view('guru.data-mata-pelajaran.show', compact('mapel'));
    }

    public function edit($id)
    {
        $mapel = MataPelajaran::findOrFail($id);
        return view('guru.data-mata-pelajaran.edit', compact('mapel'));
    }

    public function update(Request $request, $id)
    {
        $mapel = MataPelajaran::findOrFail($id);

        $validated = $request->validate([
            'nama_mapel' => 'required|string|max:100|unique:mata_pelajaran,nama_mapel,' . $id,
            'code_mapel' => 'required|string|max:20|unique:mata_pelajaran,code_mapel,' . $id,
            'nama_pengajar' => 'required|string|max:100',
            'nip_pengajar' => 'required|string|max:30|unique:mata_pelajaran,nip_pengajar,' . $id,
            'foto_pengajar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:aktif,tidak aktif'
        ]);

        // Handle file upload
        if ($request->hasFile('foto_pengajar')) {
            // Delete old photo
            if ($mapel->foto_pengajar && file_exists(public_path('uploads/foto-pengajar/' . $mapel->foto_pengajar))) {
                unlink(public_path('uploads/foto-pengajar/' . $mapel->foto_pengajar));
            }
            
            $file = $request->file('foto_pengajar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/foto-pengajar'), $filename);
            $validated['foto_pengajar'] = $filename;
        }

        $mapel->update($validated);

        return redirect()->route('guru.data-mata-pelajaran.index')->with('success', 'Data mata pelajaran berhasil diperbarui');
    }

    public function destroy($id)
    {
        $mapel = MataPelajaran::findOrFail($id);
        
        // Delete photo if exists
        if ($mapel->foto_pengajar && file_exists(public_path('uploads/foto-pengajar/' . $mapel->foto_pengajar))) {
            unlink(public_path('uploads/foto-pengajar/' . $mapel->foto_pengajar));
        }
        
        $namaMapel = $mapel->nama_mata_pelajaran; // Simpan nama untuk notifikasi
        $mapel->delete();

        return redirect()->route('guru.data-mata-pelajaran.index')->with('success_hapus', 'Data mata pelajaran atas nama ' . $namaMapel . ' berhasil dihapus!');
    }
}
