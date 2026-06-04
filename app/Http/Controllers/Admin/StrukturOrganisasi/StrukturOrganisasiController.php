<?php

namespace App\Http\Controllers\Admin\StrukturOrganisasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StrukturOrganisasi;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $strukturs = StrukturOrganisasi::orderBy('urutan')->get();
        return view('admin.struktur-organisasi.index', compact('strukturs'));
    }

    public function create()
    {
        return view('admin.struktur-organisasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_utama'     => 'required|string|max:200',
            'sub_judul'       => 'required|string|max:200',
            'jabatan'         => 'required|string|max:100',
            'nama'            => 'required|string|max:150',
            'foto'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan'          => 'required|integer|min:0',
            'teks_bawah_foto' => 'nullable|string',
        ]);

        $data = $request->only('judul_utama', 'sub_judul', 'jabatan', 'nama', 'urutan', 'teks_bawah_foto');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('struktur-organisasi', 'public');
        }

        StrukturOrganisasi::create($data);

        return redirect()->route('admin.struktur-organisasi.index')
            ->with('success', 'Anggota struktur organisasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $struktur = StrukturOrganisasi::findOrFail($id);
        return view('admin.struktur-organisasi.edit', compact('struktur'));
    }

    public function update(Request $request, $id)
    {
        $struktur = StrukturOrganisasi::findOrFail($id);

        $request->validate([
            'judul_utama'     => 'required|string|max:200',
            'sub_judul'       => 'required|string|max:200',
            'jabatan'         => 'required|string|max:100',
            'nama'            => 'required|string|max:150',
            'foto'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan'          => 'required|integer|min:0',
            'teks_bawah_foto' => 'nullable|string',
        ]);

        $data = $request->only('judul_utama', 'sub_judul', 'jabatan', 'nama', 'urutan', 'teks_bawah_foto');

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($struktur->foto) {
                Storage::disk('public')->delete($struktur->foto);
            }
            $data['foto'] = $request->file('foto')->store('struktur-organisasi', 'public');
        }

        $struktur->update($data);

        return redirect()->route('admin.struktur-organisasi.index')
            ->with('success', 'Data struktur organisasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $struktur = StrukturOrganisasi::findOrFail($id);

        if ($struktur->foto) {
            Storage::disk('public')->delete($struktur->foto);
        }

        $struktur->delete();

        return redirect()->route('admin.struktur-organisasi.index')
            ->with('success', 'Data struktur organisasi berhasil dihapus.');
    }
}
