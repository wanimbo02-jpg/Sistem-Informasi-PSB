<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * INDEX - Menampilkan halaman profile siswa
     */
    public function index()
    {
        $user = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->first();

        return view('siswa.profile.index', compact('user', 'siswa'));
    }

    /**
     * CREATE - Menampilkan form tambah data profile (jika belum ada)
     */
    public function create()
    {
        $user = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->first();

        // Jika sudah punya profile, redirect ke edit
        if ($siswa) {
            return redirect()->route('siswa.profile.edit')
                ->with('info', 'Anda sudah memiliki data profile. Silakan edit jika perlu.');
        }

        return view('siswa.profile.create', compact('user'));
    }

    /**
     * STORE - Menyimpan data profile baru
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'nisn' => 'required|string|size:10|unique:siswas,nisn',
            'nik' => 'required|string|size:16|unique:siswas,nik',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'asal_sekolah' => 'required|string|max:200',
            'nama_ayah' => 'required|string|max:100',
            'pekerjaan_ayah' => 'nullable|string|max:100',
            'nama_ibu' => 'required|string|max:100',
            'pekerjaan_ibu' => 'nullable|string|max:100',
            'no_hp_ortu' => 'required|string|max:15',
            'alamat_ortu' => 'required|string',
            'foto_siswa' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nisn.required' => 'NISN wajib diisi',
            'nisn.unique' => 'NISN sudah terdaftar',
            'nisn.size' => 'NISN harus 10 digit',
            'nik.required' => 'NIK wajib diisi',
            'nik.unique' => 'NIK sudah terdaftar',
            'nik.size' => 'NIK harus 16 digit',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'agama.required' => 'Agama wajib dipilih',
            'asal_sekolah.required' => 'Asal sekolah wajib diisi',
            'nama_ayah.required' => 'Nama ayah wajib diisi',
            'nama_ibu.required' => 'Nama ibu wajib diisi',
            'no_hp_ortu.required' => 'No HP orang tua wajib diisi',
            'alamat_ortu.required' => 'Alamat orang tua wajib diisi',
            'foto_siswa.image' => 'File harus berupa gambar',
            'foto_siswa.max' => 'Ukuran file maksimal 2MB',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            // Update data user
            $userData = [
                'no_hp' => $request->no_hp_ortu,
                'alamat' => $request->alamat_ortu,
            ];

            if ($request->hasFile('foto_siswa')) {
                $fotoPath = $request->file('foto_siswa')->store('foto-siswa/' . $user->id, 'public');
                $userData['foto'] = $fotoPath;
            }

            $user->update($userData);

            // Simpan data siswa
            $siswaData = [
                'user_id' => $user->id,
                'nisn' => $request->nisn,
                'nik' => $request->nik,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'asal_sekolah' => $request->asal_sekolah,
                'nama_ayah' => $request->nama_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'nama_ibu' => $request->nama_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'no_hp_ortu' => $request->no_hp_ortu,
                'alamat_ortu' => $request->alamat_ortu,
            ];

            if (isset($fotoPath)) {
                $siswaData['foto_siswa'] = $fotoPath;
            }

            Siswa::create($siswaData);

            DB::commit();

            return redirect()->route('siswa.profile.index')
                ->with('success', 'Profile siswa berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * SHOW - Menampilkan detail profile (sama dengan index)
     */
    public function show($id = null)
    {
        $user = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->firstOrFail();

        return view('siswa.profile.show', compact('user', 'siswa'));
    }

    /**
     * EDIT - Menampilkan form edit profile
     */
    public function edit()
    {
        $user = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->first();

        if (!$siswa) {
            return redirect()->route('siswa.profile.create')
                ->with('warning', 'Silakan buat profile terlebih dahulu.');
        }

        return view('siswa.profile.edit', compact('user', 'siswa'));
    }

    /**
     * UPDATE - Mengupdate data profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'nisn' => 'required|string|size:10|unique:siswas,nisn,' . $siswa->id,
            'nik' => 'required|string|size:16|unique:siswas,nik,' . $siswa->id,
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'asal_sekolah' => 'required|string|max:200',
            'nama_ayah' => 'required|string|max:100',
            'pekerjaan_ayah' => 'nullable|string|max:100',
            'nama_ibu' => 'required|string|max:100',
            'pekerjaan_ibu' => 'nullable|string|max:100',
            'no_hp_ortu' => 'required|string|max:15',
            'alamat_ortu' => 'required|string',
            'foto_siswa' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'current_password' => 'nullable|required_with:new_password|current_password',
            'new_password' => 'nullable|min:8|confirmed',
        ], [
            'nisn.required' => 'NISN wajib diisi',
            'nisn.unique' => 'NISN sudah terdaftar',
            'nisn.size' => 'NISN harus 10 digit',
            'nik.required' => 'NIK wajib diisi',
            'nik.unique' => 'NIK sudah terdaftar',
            'nik.size' => 'NIK harus 16 digit',
            'current_password.required_with' => 'Password saat ini wajib diisi jika ingin mengganti password',
            'current_password.current_password' => 'Password saat ini salah',
            'new_password.min' => 'Password baru minimal 8 karakter',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            // Update data user
            $userData = [
                'no_hp' => $request->no_hp_ortu,
                'alamat' => $request->alamat_ortu,
            ];

            // Update password jika diisi
            if ($request->filled('new_password')) {
                $userData['password'] = Hash::make($request->new_password);
            }

            // Upload foto baru jika ada
            if ($request->hasFile('foto_siswa')) {
                // Hapus foto lama
                if ($user->foto) {
                    Storage::disk('public')->delete($user->foto);
                }
                if ($siswa->foto_siswa) {
                    Storage::disk('public')->delete($siswa->foto_siswa);
                }

                $fotoPath = $request->file('foto_siswa')->store('foto-siswa/' . $user->id, 'public');
                $userData['foto'] = $fotoPath;
            }

            $user->update($userData);

            // Update data siswa
            $siswaData = [
                'nisn' => $request->nisn,
                'nik' => $request->nik,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'asal_sekolah' => $request->asal_sekolah,
                'nama_ayah' => $request->nama_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'nama_ibu' => $request->nama_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'no_hp_ortu' => $request->no_hp_ortu,
                'alamat_ortu' => $request->alamat_ortu,
            ];

            if (isset($fotoPath)) {
                $siswaData['foto_siswa'] = $fotoPath;
            }

            $siswa->update($siswaData);

            DB::commit();

            return redirect()->route('siswa.profile.index')
                ->with('success', 'Profile siswa berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * DESTROY - Menghapus profile (dengan konfirmasi)
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->first();

        if (!$siswa) {
            return redirect()->route('siswa.profile.index')
                ->with('error', 'Data profile tidak ditemukan.');
        }

        $validator = Validator::make($request->all(), [
            'password' => 'required|current_password',
        ], [
            'password.required' => 'Password wajib diisi untuk konfirmasi',
            'password.current_password' => 'Password yang Anda masukkan salah',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            // Hapus foto-foto
            if ($siswa->foto_siswa) {
                Storage::disk('public')->delete($siswa->foto_siswa);
            }
            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
            }

            // Hapus data siswa
            $siswa->delete();

            // Reset data user
            $user->update([
                'no_hp' => null,
                'alamat' => null,
                'foto' => null,
            ]);

            DB::commit();

            return redirect()->route('siswa.dashboard')
                ->with('success', 'Profile siswa berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * UPDATE FOTO - Khusus update foto profile
     */
   /**
 * UPDATE FOTO - Khusus update foto profile (via AJAX)
 */
public function updateFoto(Request $request)
{
    $validator = Validator::make($request->all(), [
        'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    $user = Auth::user();
    $siswa = Siswa::where('user_id', $user->id)->first();

    // Hapus foto lama jika ada
    if ($user->foto) {
        Storage::disk('public')->delete($user->foto);
    }
    if ($siswa && $siswa->foto_siswa) {
        Storage::disk('public')->delete($siswa->foto_siswa);
    }

    // Upload foto baru
    try {
        $fotoPath = $request->file('foto')->store('foto-siswa/' . $user->id, 'public');

        // Update user dan siswa
        $user->update(['foto' => $fotoPath]);
        if ($siswa) {
            $siswa->update(['foto_siswa' => $fotoPath]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil diperbarui',
            'foto' => asset('storage/' . $fotoPath)
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Gagal mengupload foto: ' . $e->getMessage()
        ], 500);
    }
}

    /**
     * GET PROFILE DATA - Untuk keperluan AJAX
     */
    public function getData()
    {
        $user = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->first();

        return response()->json([
            'user' => $user,
            'siswa' => $siswa
        ]);
    }
}
