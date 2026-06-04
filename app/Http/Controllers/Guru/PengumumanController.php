<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumanSeleksi = Pengumuman::where('jenis_pengumuman', 'seleksi_administrasi')->orderBy('created_at', 'desc')->first();
        $pengumumanFinal = Pengumuman::where('jenis_pengumuman', 'pengumuman_final')->orderBy('created_at', 'desc')->first();
        return view('guru.pengumuman.index', compact('pengumumanSeleksi', 'pengumumanFinal'));
    }

    public function create()
    {
        return view('guru.pengumuman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_pengumuman' => 'required|in:seleksi_administrasi,pengumuman_final',
            'judul' => 'required|string|max:200',
            'sub_judul' => 'nullable|string|max:200',
            'isi' => 'nullable|string',
            'file' => 'nullable|file|mimes:doc,docx,xls,xlsx,pdf|max:5120',
            'tahun_ajaran' => 'nullable|string|max:50',
            'aktif' => 'nullable|boolean',
        ]);

        $data = $request->only('jenis_pengumuman', 'judul', 'sub_judul', 'isi', 'tahun_ajaran');
        $data['aktif'] = $request->has('aktif') ? true : false;
        $data['penting'] = true;
        $data['tanggal_publikasi'] = now();

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('pengumuman', 'public');
        }

        Pengumuman::create($data);

        return redirect()->route('guru.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('guru.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        $request->validate([
            'jenis_pengumuman' => 'required|in:seleksi_administrasi,pengumuman_final',
            'judul' => 'required|string|max:200',
            'sub_judul' => 'nullable|string|max:200',
            'isi' => 'nullable|string',
            'file' => 'nullable|file|mimes:doc,docx,xls,xlsx,pdf|max:5120',
            'tahun_ajaran' => 'nullable|string|max:50',
            'aktif' => 'nullable|boolean',
        ]);

        $data = $request->only('jenis_pengumuman', 'judul', 'sub_judul', 'isi', 'tahun_ajaran');
        $data['aktif'] = $request->has('aktif') ? true : false;

        if ($request->hasFile('file')) {
            if ($pengumuman->file) {
                Storage::disk('public')->delete($pengumuman->file);
            }
            $data['file'] = $request->file('file')->store('pengumuman', 'public');
        }

        $pengumuman->update($data);

        return redirect()->route('guru.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }
}
