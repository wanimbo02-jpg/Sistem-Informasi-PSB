<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DataGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Data sample - dalam implementasi nyata, ambil dari database
        $gurus = [
            (object) [
                'id' => 1,
                'nama_lengkap' => 'John Doe',
                'nip' => '1987654321',
                'email' => 'john.doe@sekolah.sch.id',
                'telepon' => '08123456789',
                'status' => 'aktif',
                'mata_pelajaran' => 'Matematika, Fisika',
                'foto' => null,
                'tanggal_lahir' => '1985-01-15',
                'pendidikan_terakhir' => 'S2 Pendidikan Matematika',
                'tahun_masuk' => 2010,
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Pendidikan No. 123, Jakarta Selatan'
            ],
            (object) [
                'id' => 2,
                'nama_lengkap' => 'Jane Smith',
                'nip' => '1987654322',
                'email' => 'jane.smith@sekolah.sch.id',
                'telepon' => '08123456790',
                'status' => 'aktif',
                'mata_pelajaran' => 'Bahasa Indonesia, Bahasa Inggris',
                'foto' => null,
                'tanggal_lahir' => '1987-05-22',
                'pendidikan_terakhir' => 'S2 Pendidikan Bahasa',
                'tahun_masuk' => 2012,
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Guru No. 456, Jakarta Pusat'
            ],
            (object) [
                'id' => 3,
                'nama_lengkap' => 'Bob Wilson',
                'nip' => '1987654323',
                'email' => 'bob.wilson@sekolah.sch.id',
                'telepon' => '08123456791',
                'status' => 'tidak-aktif',
                'mata_pelajaran' => 'Kimia, Biologi',
                'foto' => null,
                'tanggal_lahir' => '1982-09-10',
                'pendidikan_terakhir' => 'S1 Pendidikan Kimia',
                'tahun_masuk' => 2008,
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Kimia No. 789, Jakarta Utara'
            ]
        ];

        return view('guru.data-guru.index', compact('gurus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guru.data-guru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nip' => 'required|string|max:50',
            'email' => 'required|email|max:255',
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

        // Dalam implementasi nyata, simpan ke database
        // Guru::create($validated);

        return redirect()->route('guru.data-guru.index')
            ->with('success', 'Data guru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Dalam implementasi nyata, ambil data guru dari database
        $guru = (object) [
            'id' => $id,
            'nama_lengkap' => 'John Doe',
            'nip' => '1987654321',
            'email' => 'john.doe@sekolah.sch.id',
            'telepon' => '08123456789',
            'status' => 'aktif',
            'mata_pelajaran' => 'Matematika, Fisika',
            'foto' => null,
            'tanggal_lahir' => '1985-01-15',
            'pendidikan_terakhir' => 'S2 Pendidikan Matematika',
            'tahun_masuk' => 2010,
            'jenis_kelamin' => 'L',
            'alamat' => 'Jl. Pendidikan No. 123, Jakarta Selatan'
        ];

        return view('guru.data-guru.show', compact('guru'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Dalam implementasi nyata, ambil data guru dari database
        $guru = (object) [
            'id' => $id,
            'nama_lengkap' => 'John Doe',
            'nip' => '1987654321',
            'email' => 'john.doe@sekolah.sch.id',
            'telepon' => '08123456789',
            'status' => 'aktif',
            'mata_pelajaran' => 'Matematika, Fisika',
            'foto' => null,
            'tanggal_lahir' => '1985-01-15',
            'pendidikan_terakhir' => 'S2 Pendidikan Matematika',
            'tahun_masuk' => 2010,
            'jenis_kelamin' => 'L',
            'alamat' => 'Jl. Pendidikan No. 123, Jakarta Selatan'
        ];

        return view('guru.data-guru.edit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nip' => 'required|string|max:50',
            'email' => 'required|email|max:255',
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

        // Dalam implementasi nyata, update ke database
        // Guru::findOrFail($id)->update($validated);

        return redirect()->route('guru.data-guru.index')
            ->with('success', 'Data guru berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Dalam implementasi nyata, hapus dari database
        // Guru::findOrFail($id)->delete();

        return redirect()->route('guru.data-guru.index')
            ->with('success', 'Data guru berhasil dihapus!');
    }
}
