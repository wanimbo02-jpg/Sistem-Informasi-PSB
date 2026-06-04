<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Guru;

class DataGuruController extends Controller
{
    /**
     * Menampilkan daftar semua guru
     */
    public function index()
    {
        // Ambil data dari database dengan pagination
        $gurus = Guru::orderBy('created_at', 'desc')->paginate(10);
        
        return view('guru.data-guru.index', compact('gurus'));
    }

    /**
     * Menampilkan form tambah guru
     */
    public function create()
    {
        return view('guru.data-guru.create');
    }

    /**
     * Menyimpan data guru baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nip' => 'required|string|max:50|unique:gurus,nip',
            'email' => 'required|email|max:255|unique:gurus,email',
            'telepon' => 'required|string|max:20',
            'status' => 'required|in:aktif,tidak-aktif',
            'mata_pelajaran' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_lahir' => 'required|date',
            'pendidikan_terakhir' => 'required|string|max:255',
            'tahun_masuk' => 'required|integer|min:2000|max:' . date('Y'),
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string|max:500'
        ]);

        // Handle file upload
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoPath = $foto->store('guru/foto', 'public');
            $validated['foto'] = $fotoPath;
        }

        // Simpan ke database
        Guru::create($validated);

        return redirect()->route('guru.data-guru.index')
            ->with('success', 'Data guru berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail guru
     */
    public function show($id)
    {
        $guru = Guru::findOrFail($id);
        
        return view('guru.data-guru.show', compact('guru'));
    }

    /**
     * Menampilkan form edit guru
     */
    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        
        return view('guru.data-guru.edit', compact('guru'));
    }

    /**
     * Update data guru
     */
    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);
        
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nip' => 'required|string|max:50|unique:gurus,nip,' . $id,
            'email' => 'required|email|max:255|unique:gurus,email,' . $id,
            'telepon' => 'required|string|max:20',
            'status' => 'required|in:aktif,tidak-aktif',
            'mata_pelajaran' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_lahir' => 'nullable|date',
            'pendidikan_terakhir' => 'required|string|max:255',
            'tahun_masuk' => 'required|integer|min:2000|max:' . date('Y'),
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string|max:500'
        ]);

        // Handle file upload
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoPath = $foto->store('guru/foto', 'public');
            $validated['foto'] = $fotoPath;
        }

        // Pertahankan tanggal lahir lama jika tidak diisi
        if (empty($validated['tanggal_lahir'])) {
            $validated['tanggal_lahir'] = $guru->tanggal_lahir;
        }

        $guru->update($validated);

        return redirect()->route('guru.data-guru.index')
            ->with('success', 'Data guru berhasil diperbarui!');
    }

    /**
     * Hapus data guru
     */
    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $namaGuru = $guru->nama; // Simpan nama untuk notifikasi
        $guru->delete();

        return redirect()->route('guru.data-guru.index')
            ->with('success_hapus', 'Data guru atas nama ' . $namaGuru . ' berhasil dihapus!');
    }
}