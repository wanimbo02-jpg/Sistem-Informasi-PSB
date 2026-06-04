<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class DataKelasController extends Controller
{
    public function index()
    {
        $dataKelas = Kelas::orderBy('nama_kelas')->paginate(10);
        
        // Statistik
        $totalKelas = Kelas::count();
        $totalSiswa = Kelas::sum('total_siswa');
        $totalLakiLaki = Kelas::sum('laki_laki');
        $totalPerempuan = Kelas::sum('perempuan');
        $totalKelasIPA = Kelas::where('jurusan', 'IPA')->count();
        $totalKelasIPS = Kelas::where('jurusan', 'IPS')->count();

        return view('guru.data-kelas.index', compact(
            'dataKelas',
            'totalKelas',
            'totalSiswa',
            'totalLakiLaki',
            'totalPerempuan',
            'totalKelasIPA',
            'totalKelasIPS'
        ));
    }

    public function create()
    {
        return view('guru.data-kelas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:50|unique:kelas,nama_kelas',
            'jurusan' => 'required|in:IPA,IPS',
            'wali_kelas' => 'required|string|max:100',
            'semester' => 'required|string|max:50',
            'total_siswa' => 'required|integer|min:0',
            'laki_laki' => 'required|integer|min:0',
            'perempuan' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string|max:500'
        ]);

        // Validasi total siswa
        if ($validated['laki_laki'] + $validated['perempuan'] != $validated['total_siswa']) {
            return back()->withErrors(['total_siswa' => 'Total siswa harus sama dengan jumlah laki-laki dan perempuan'])->withInput();
        }

        Kelas::create($validated);

        return redirect()->route('guru.data-kelas.index')->with('success', 'Data kelas berhasil ditambahkan');
    }

    public function show($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('guru.data-kelas.show', compact('kelas'));
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('guru.data-kelas.edit', compact('kelas'));
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:50|unique:kelas,nama_kelas,' . $id,
            'jurusan' => 'required|in:IPA,IPS',
            'wali_kelas' => 'required|string|max:100',
            'semester' => 'required|string|max:50',
            'total_siswa' => 'required|integer|min:0',
            'laki_laki' => 'required|integer|min:0',
            'perempuan' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string|max:500'
        ]);

        // Validasi total siswa
        if ($validated['laki_laki'] + $validated['perempuan'] != $validated['total_siswa']) {
            return back()->withErrors(['total_siswa' => 'Total siswa harus sama dengan jumlah laki-laki dan perempuan'])->withInput();
        }

        $kelas->update($validated);

        return redirect()->route('guru.data-kelas.index')->with('success', 'Data kelas berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $namaKelas = $kelas->nama_kelas; // Simpan nama untuk notifikasi
        $kelas->delete();

        return redirect()->route('guru.data-kelas.index')->with('success_hapus', 'Data kelas atas nama ' . $namaKelas . ' berhasil dihapus!');
    }
}
