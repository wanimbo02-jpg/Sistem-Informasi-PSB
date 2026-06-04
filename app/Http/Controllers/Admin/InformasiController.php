<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Informasi;

class InformasiController extends Controller
{
    public function index()
    {
        $informasis = Informasi::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.informasi.index', compact('informasis'));
    }

    public function create()
    {
        return view('admin.informasi.create');
    }

    public function store(Request $request)
    {
        // Debug: Tampilkan semua request data
        // dd($request->all());
        
        // Gabungkan semua data menjadi satu konten
        $konten = $this->formatKontenInformasi($request);
        
        $validated = $request->validate([
            'judul_utama' => 'required|string|max:255',
            'sub_judul' => 'required|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
            'nama_siswa' => 'nullable|string|max:255',
            'keterangan_siswa' => 'nullable|string|max:500',
            'foto_siswa' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Default tampilkan_di jika tidak ada
        $tampilkanDi = $request->input('tampilkan_di', 'semua');

        // Get existing data
        $existingData = [];

        // Handle upload foto siswa
        $fotoPath = null;
        if ($request->hasFile('foto_siswa')) {
            $fotoPath = $request->file('foto_siswa')->store('foto_siswa', 'public');
        }

        // Simpan sebagai JSON untuk struktur data
        $dataInformasi = [
            'judul' => $validated['judul_utama'],
            'sub_judul' => $validated['sub_judul'],
            'jadwal' => $request->jadwal ?? [],
            'persyaratan' => $request->persyaratan ?? [],
            'kontak' => $request->kontak ?? [],
            'status' => $validated['status'],
            'tampilkan_di' => $tampilkanDi,
            'nama_siswa' => $validated['nama_siswa'] ?? '',
            'keterangan_siswa' => $validated['keterangan_siswa'] ?? '',
            'foto_siswa' => $fotoPath,
            'konten' => $konten
        ];

        // Debug: Tampilkan data yang akan disimpan
        // dd($dataInformasi);

        Informasi::create([
            'judul' => $validated['judul_utama'],
            'konten' => json_encode($dataInformasi),
            'status' => $validated['status']
        ]);

        return redirect()->route('admin.informasi.index')
            ->with('success', 'Informasi PPDB berhasil ditambahkan!');
    }

    private function formatKontenInformasi($request)
    {
        $html = '<div class="informasi-ppdb">';
        
        // Header
        $html .= '<div class="text-center mb-4">';
        $html .= '<h1 class="fw-bold text-primary">' . e($request->judul_utama) . '</h1>';
        $html .= '<h3 class="text-muted">' . e($request->sub_judul) . '</h3>';
        $html .= '</div>';

        // Jadwal
        if (!empty($request->jadwal)) {
            $html .= '<div class="mb-4">';
            $html .= '<h4 class="mb-3">📅 Jadwal Pendaftaran & Seleksi</h4>';
            $html .= '<div class="table-responsive">';
            $html .= '<table class="table table-bordered">';
            $html .= '<thead class="table-light"><tr><th>Kegiatan</th><th>Tanggal</th><th>Keterangan</th></tr></thead>';
            $html .= '<tbody>';
            
            foreach ($request->jadwal as $jadwal) {
                if (!empty($jadwal['kegiatan'])) {
                    $html .= '<tr>';
                    $html .= '<td>' . e($jadwal['kegiatan']) . '</td>';
                    $html .= '<td>' . e($jadwal['tanggal']) . '</td>';
                    $html .= '<td>' . e($jadwal['keterangan']) . '</td>';
                    $html .= '</tr>';
                }
            }
            
            $html .= '</tbody></table></div></div>';
        }

        // Persyaratan
        if (!empty($request->persyaratan)) {
            $html .= '<div class="mb-4">';
            $html .= '<h4 class="mb-3">📋 Persyaratan Pendaftaran</h4>';
            $html .= '<div class="table-responsive">';
            $html .= '<table class="table table-bordered">';
            $html .= '<thead class="table-light"><tr><th>No</th><th>Persyaratan</th></tr></thead>';
            $html .= '<tbody>';
            
            foreach ($request->persyaratan as $index => $persyaratan) {
                if (!empty($persyaratan['nama'])) {
                    $html .= '<tr>';
                    $html .= '<td>' . ($index + 1) . '</td>';
                    $html .= '<td>' . e($persyaratan['nama']) . '</td>';
                    $html .= '</tr>';
                }
            }
            
            $html .= '</tbody></table></div></div>';
        }

        // Kontak
        if (!empty($request->kontak)) {
            $html .= '<div class="mb-4">';
            $html .= '<h4 class="mb-3">📞 Kontak Panitia</h4>';
            $html .= '<div class="table-responsive">';
            $html .= '<table class="table table-bordered">';
            $html .= '<thead class="table-light"><tr><th>Tipe</th><th>Kontak</th></tr></thead>';
            $html .= '<tbody>';
            
            foreach ($request->kontak as $kontakItem) {
                if (!empty($kontakItem['nilai'])) {
                    $html .= '<tr>';
                    $html .= '<td>' . ucfirst($kontakItem['tipe']) . '</td>';
                    $html .= '<td>' . e($kontakItem['nilai']) . '</td>';
                    $html .= '</tr>';
                }
            }
            
            $html .= '</tbody></table></div></div>';
        }

        $html .= '</div>';
        
        return $html;
    }

    public function show($id)
    {
        $informasi = Informasi::findOrFail($id);
        
        // Parse JSON data untuk ditampilkan
        $dataInformasi = json_decode($informasi->konten, true);
        
        // Extract data untuk kemudahan akses di view
        $judul = $dataInformasi['judul'] ?? $informasi->judul;
        $subJudul = $dataInformasi['sub_judul'] ?? '';
        $status = $dataInformasi['status'] ?? $informasi->status;
        $tampilkanDi = $dataInformasi['tampilkan_di'] ?? 'semua';
        $kontenHtml = $dataInformasi['konten'] ?? '';
        $jadwal = $dataInformasi['jadwal'] ?? [];
        $persyaratan = $dataInformasi['persyaratan'] ?? [];
        $kontak = $dataInformasi['kontak'] ?? [];
        $namaSiswa = $dataInformasi['nama_siswa'] ?? '';
        $keteranganSiswa = $dataInformasi['keterangan_siswa'] ?? '';
        $fotoSiswa = $dataInformasi['foto_siswa'] ?? '';
        
        return view('admin.informasi.show', compact(
            'informasi', 
            'dataInformasi',
            'judul',
            'subJudul', 
            'status',
            'tampilkanDi',
            'kontenHtml',
            'jadwal',
            'persyaratan',
            'kontak',
            'namaSiswa',
            'keteranganSiswa',
            'fotoSiswa'
        ));
    }

    public function edit($id)
    {
        $informasi = Informasi::findOrFail($id);
        $dataInformasi = json_decode($informasi->konten, true) ?? [];
        
        return view('admin.informasi.edit', compact('informasi', 'dataInformasi'));
    }

    public function update(Request $request, $id)
    {
        // Debug: Tampilkan semua request data
        // dd($request->all());
        
        // Gabungkan semua data menjadi satu konten
        $konten = $this->formatKontenInformasi($request);
        
        $validated = $request->validate([
            'judul_utama' => 'required|string|max:255',
            'sub_judul' => 'required|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
            'nama_siswa' => 'nullable|string|max:255',
            'keterangan_siswa' => 'nullable|string|max:500',
            'foto_siswa' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Default tampilkan_di jika tidak ada
        $tampilkanDi = $request->input('tampilkan_di', 'semua');

        // Get existing data
        $informasi = Informasi::findOrFail($id);
        $existingData = json_decode($informasi->konten, true) ?? [];

        // Handle upload foto siswa
        $fotoPath = $existingData['foto_siswa'] ?? null; // Keep existing foto if no new upload
        if ($request->hasFile('foto_siswa')) {
            $fotoPath = $request->file('foto_siswa')->store('foto_siswa', 'public');
        }

        // Simpan sebagai JSON untuk struktur data
        $dataInformasi = [
            'judul' => $validated['judul_utama'],
            'sub_judul' => $validated['sub_judul'],
            'jadwal' => $request->jadwal ?? [],
            'persyaratan' => $request->persyaratan ?? [],
            'kontak' => $request->kontak ?? [],
            'status' => $validated['status'],
            'tampilkan_di' => $tampilkanDi,
            'nama_siswa' => $validated['nama_siswa'] ?? ($existingData['nama_siswa'] ?? ''),
            'keterangan_siswa' => $validated['keterangan_siswa'] ?? ($existingData['keterangan_siswa'] ?? ''),
            'foto_siswa' => $fotoPath,
            'konten' => $konten
        ];

        // Debug: Tampilkan data yang akan disimpan
        // dd($dataInformasi);

        $informasi->update([
            'judul' => $validated['judul_utama'],
            'konten' => json_encode($dataInformasi),
            'status' => $validated['status']
        ]);

        return redirect()->route('admin.informasi.index')
            ->with('success', 'Informasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $informasi = Informasi::findOrFail($id);
        $informasi->delete();

        return redirect()->route('admin.informasi.index')
            ->with('success', 'Informasi berhasil dihapus!');
    }
}
