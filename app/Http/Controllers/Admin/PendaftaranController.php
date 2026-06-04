<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Berkas; // Tambahkan use untuk model Berkas
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of all registrations.
     */
    public function index(Request $request)
    {
        $query = Pendaftaran::with(['user', 'siswa', 'berkas'])
            ->orderBy('created_at', 'desc');

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            // PERBAIKAN: Gunakan 'status' bukan 'status_pendaftaran'
            $query->where('status', $request->status);
        }

        // Filter berdasarkan jurusan
        if ($request->has('jurusan') && $request->jurusan != '') {
            $query->where('jurusan1', $request->jurusan);
        }

        // Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('no_pendaftaran', 'like', "%{$search}%")
                  ->orWhereHas('siswa', function($sq) use ($search) {
                      $sq->where('nama_lengkap', 'like', "%{$search}%")
                         ->orWhere('nisn', 'like', "%{$search}%");
                  });
            });
        }

        $pendaftarans = $query->paginate(15);

        // PERBAIKAN: Sesuaikan dengan kolom yang ada di database
        $statistik = [
            'total' => Pendaftaran::count(),
            'menunggu' => Pendaftaran::where('status', 'pending')->count(),
            'diproses' => Pendaftaran::where('status', 'diproses')->count() ?: 0,
            'diterima' => Pendaftaran::where('status', 'diterima')->count(),
            'ditolak' => Pendaftaran::where('status', 'ditolak')->count(),
            'verifikasi_pending' => 0, // Default 0 karena kolom status_berkas tidak ada di tabel pendaftaran
        ];

        return view('admin.pendaftaran.index', compact('pendaftarans', 'statistik'));
    }

    /**
     * Show the form for creating a new registration (manual by admin).
     */
    public function create()
    {
        // Ambil user yang belum memiliki pendaftaran
        $users = User::where('role', 'siswa')
            ->whereDoesntHave('pendaftaran')
            ->get();

        return view('admin.pendaftaran.create', compact('users'));
    }

    /**
     * Store a newly created registration.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jurusan1' => 'required|in:IPA,IPS,BAHASA',
            'jurusan2' => 'nullable|in:IPA,IPS,BAHASA|different:jurusan1',
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);

        DB::beginTransaction();
        try {
            // Generate nomor pendaftaran
            $noPendaftaran = Pendaftaran::generateNoPendaftaran();

            // PERBAIKAN: Gunakan 'status' bukan 'status_pendaftaran' dan hapus 'status_berkas'
            $pendaftaran = Pendaftaran::create([
                'no_pendaftaran' => $noPendaftaran,
                'user_id' => $request->user_id,
                'jalur_pendaftaran' => $request->jalur_pendaftaran ?? 'umum',
                'jurusan1' => $request->jurusan1,
                'jurusan2' => $request->jurusan2,
                'nama_ayah' => $request->nama_ayah,
                'nik_ayah' => $request->nik_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'pendidikan_ayah' => $request->pendidikan_ayah,
                'penghasilan_ayah' => $request->penghasilan_ayah,
                'telepon_ayah' => $request->telepon_ayah,
                'nama_ibu' => $request->nama_ibu,
                'nik_ibu' => $request->nik_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'pendidikan_ibu' => $request->pendidikan_ibu,
                'penghasilan_ibu' => $request->penghasilan_ibu,
                'telepon_ibu' => $request->telepon_ibu,
                'status' => 'pending', // Gunakan 'status' dengan value 'pending'
                // Hapus 'status_berkas' karena kolom tidak ada di tabel pendaftaran
            ]);

            DB::commit();

            return redirect()->route('admin.pendaftaran.index')
                ->with('success', 'Pendaftaran berhasil ditambahkan dengan nomor: ' . $noPendaftaran);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified registration.
     */
    public function show($id)
    {
        $pendaftaran = Pendaftaran::with(['user', 'siswa', 'verifikator', 'berkas'])
            ->findOrFail($id);

        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    /**
     * Show the form for editing the specified registration.
     */
    public function edit($id)
    {
        $pendaftaran = Pendaftaran::with('user')->findOrFail($id);

        return view('admin.pendaftaran.edit', compact('pendaftaran'));
    }

    /**
     * Update the specified registration.
     */
    public function update(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $request->validate([
            'jurusan1' => 'required|in:IPA,IPS,BAHASA',
            'jurusan2' => 'nullable|in:IPA,IPS,BAHASA|different:jurusan1',
            'status' => 'required|in:pending,diproses,diterima,ditolak', // PERBAIKAN: status bukan status_pendaftaran
            // Hapus validasi status_berkas
        ]);

        $pendaftaran->update($request->only([
            'jalur_pendaftaran', 'jurusan1', 'jurusan2',
            'nama_ayah', 'nik_ayah', 'pekerjaan_ayah', 'pendidikan_ayah',
            'penghasilan_ayah', 'telepon_ayah',
            'nama_ibu', 'nik_ibu', 'pekerjaan_ibu', 'pendidikan_ibu',
            'penghasilan_ibu', 'telepon_ibu',
            'status', 'catatan' // PERBAIKAN: gunakan 'status' bukan 'status_pendaftaran'
        ]));

        return redirect()->route('admin.pendaftaran.index')
            ->with('success', 'Data pendaftaran berhasil diperbarui');
    }

    /**
     * Verifikasi berkas pendaftaran.
     */
    public function verifikasi(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $request->validate([
            'status_berkas' => 'required|in:diverifikasi,ditolak',
            'catatan' => 'nullable|string',
        ]);

        // PERBAIKAN: Status berkas disimpan di tabel Berkas, bukan di Pendaftaran
        if ($pendaftaran->berkas) {
            $pendaftaran->berkas->update([
                'status' => $request->status_berkas,
                'catatan' => $request->catatan,
            ]);
        }

        // Update status pendaftaran
        if ($request->status_berkas == 'diverifikasi') {
            $pendaftaran->update(['status' => 'diproses']); // PERBAIKAN: gunakan 'status'
        }

        return redirect()->route('admin.pendaftaran.show', $id)
            ->with('success', 'Berkas berhasil diverifikasi');
    }

    /**
     * Update status kelulusan.
     */
    public function updateKelulusan(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $request->validate([
            'status' => 'required|in:diterima,ditolak', // PERBAIKAN: gunakan 'status'
            'jurusan_diterima' => 'required_if:status,diterima|in:IPA,IPS,BAHASA',
            'catatan' => 'nullable|string',
        ]);

        $updateData = [
            'status' => $request->status, // PERBAIKAN: gunakan 'status'
            'catatan' => $request->catatan,
        ];

        if ($request->status == 'diterima') {
            $updateData['jurusan_diterima'] = $request->jurusan_diterima;
        }

        $pendaftaran->update($updateData);

        return redirect()->route('admin.pendaftaran.show', $id)
            ->with('success', 'Status kelulusan berhasil diperbarui');
    }

    /**
     * Remove the specified registration.
     */
    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Hapus file-file terkait
        if ($pendaftaran->berkas) {
            $files = [
                $pendaftaran->berkas->file_ijazah,
                $pendaftaran->berkas->file_kk,
                $pendaftaran->berkas->file_akte,
                $pendaftaran->berkas->file_pas_foto,
                $pendaftaran->berkas->file_skhun,
                $pendaftaran->berkas->file_prestasi
            ];

            foreach ($files as $file) {
                if ($file && \Storage::disk('public')->exists($file)) {
                    \Storage::disk('public')->delete($file);
                }
            }
        }

        $pendaftaran->delete();

        return redirect()->route('admin.pendaftaran.index')
            ->with('success', 'Data pendaftaran berhasil dihapus');
    }

    /**
     * Export data pendaftaran ke Excel/PDF.
     */
    public function export(Request $request)
    {
        // Implementasi export sesuai kebutuhan
        // Bisa menggunakan package seperti maatwebsite/excel
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diterima,ditolak', // PERBAIKAN: gunakan 'status'
            'catatan_admin' => 'nullable|string'
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update([
            'status' => $request->status, // PERBAIKAN: gunakan 'status'
            'catatan_admin' => $request->catatan_admin
        ]);

        return redirect()->back()->with('success', 'Status pendaftaran berhasil diperbarui');
    }
}