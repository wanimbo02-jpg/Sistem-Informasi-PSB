<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PengaturanAkunController extends Controller
{
    public function index()
    {
        // Ambil data admin (user dengan role admin)
        $admin = User::where('role', 'admin')->first();
        
        // Ambil data guru (user dengan role guru)
        $guru = User::where('role', 'guru')->first();
        
        return view('admin.pengaturan.index', compact('admin', 'guru'));
    }

    public function updateAdmin(Request $request)
    {
        // Hapus semua admin duplikat kecuali yang pertama
        $allAdmins = User::where('role', 'admin')->get();
        if ($allAdmins->count() > 1) {
            $keepAdmin = $allAdmins->first();
            foreach ($allAdmins as $admin) {
                if ($admin->id !== $keepAdmin->id) {
                    $admin->delete();
                }
            }
        }

        // Cari admin yang ada untuk validasi unique
        $admin = User::where('role', 'admin')->first();
        $adminId = $admin ? $admin->id : null;

        // Validasi input
        $validator = Validator::make($request->all(), [
            'admin_name'     => 'required|string|max:255',
            'admin_nip'      => 'required|string|max:20|unique:users,nip,' . $adminId,
            'admin_email'    => 'required|email|max:255|unique:users,email,' . $adminId,
            'admin_password' => 'nullable|string|min:6|confirmed',
        ], [
            'admin_name.required'      => 'Nama admin wajib diisi',
            'admin_nip.required'       => 'NIP admin wajib diisi',
            'admin_nip.unique'         => 'NIP admin sudah digunakan',
            'admin_email.required'     => 'Email admin wajib diisi',
            'admin_email.unique'       => 'Email admin sudah digunakan',
            'admin_password.min'       => 'Password minimal 6 karakter',
            'admin_password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Perubahan data admin gagal!');
        }

        try {
            if (!$admin) {
                $admin = new User();
                $admin->role      = 'admin';
                $admin->is_active = true;
            }

            $admin->name  = $request->admin_name;
            $admin->nip   = $request->admin_nip;
            $admin->email = $request->admin_email;

            // Hanya update password jika diisi
            if (!empty($request->admin_password)) {
                $admin->password = Hash::make($request->admin_password);
            }

            $admin->save();

            return redirect()->route('admin.pengaturan.akun')
                ->with('success', 'Akun admin berhasil diperbarui.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function updateGuru(Request $request)
    {
        // Hapus semua guru duplikat kecuali yang pertama
        $allGurus = User::where('role', 'guru')->get();
        if ($allGurus->count() > 1) {
            $keepGuru = $allGurus->first();
            foreach ($allGurus as $guru) {
                if ($guru->id !== $keepGuru->id) {
                    $guru->delete();
                }
            }
        }

        // Cari guru yang ada untuk validasi unique
        $guru = User::where('role', 'guru')->first();
        $guruId = $guru ? $guru->id : null;

        // Validasi input
        $validator = Validator::make($request->all(), [
            'guru_name'     => 'required|string|max:255',
            'guru_nip'      => 'required|string|max:20|unique:users,nip,' . $guruId,
            'guru_email'    => 'required|email|max:255|unique:users,email,' . $guruId,
            'guru_password' => 'nullable|string|min:6|confirmed',
        ], [
            'guru_name.required'      => 'Nama guru wajib diisi',
            'guru_nip.required'       => 'NIP guru wajib diisi',
            'guru_nip.unique'         => 'NIP guru sudah digunakan',
            'guru_email.required'     => 'Email guru wajib diisi',
            'guru_email.unique'       => 'Email guru sudah digunakan',
            'guru_password.min'       => 'Password minimal 6 karakter',
            'guru_password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Perubahan data guru gagal!');
        }

        try {
            if (!$guru) {
                $guru = new User();
                $guru->role      = 'guru';
                $guru->is_active = true;
            }

            $guru->name  = $request->guru_name;
            $guru->nip   = $request->guru_nip;
            $guru->email = $request->guru_email;

            // Hanya update password jika diisi
            if (!empty($request->guru_password)) {
                $guru->password = Hash::make($request->guru_password);
            }

            $guru->save();

            return redirect()->route('admin.pengaturan.akun')
                ->with('success', 'Akun guru berhasil diperbarui.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function createAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admin_name'     => 'required|string|max:255',
            'admin_nip'      => 'required|string|max:255|unique:users,nip',
            'admin_email'    => 'required|email|max:255|unique:users,email',
            'admin_password' => 'required|string|min:6|confirmed',
        ], [
            'admin_name.required'      => 'Nama admin wajib diisi',
            'admin_nip.required'       => 'NIP admin wajib diisi',
            'admin_nip.unique'         => 'NIP sudah digunakan akun lain',
            'admin_email.required'     => 'Email admin wajib diisi',
            'admin_email.unique'       => 'Email sudah digunakan akun lain',
            'admin_password.required'  => 'Password wajib diisi',
            'admin_password.min'       => 'Password minimal 6 karakter',
            'admin_password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal membuat akun admin: ' . $validator->errors()->first());
        }

        try {
            // Create new admin — nik diisi sama dengan nip agar tidak error NOT NULL
            User::create([
                'name'      => $request->admin_name,
                'nik'       => $request->admin_nip,
                'nip'       => $request->admin_nip,
                'email'     => $request->admin_email,
                'password'  => Hash::make($request->admin_password),
                'role'      => 'admin',
                'is_active' => true,
                'status'    => 'aktif',
            ]);

            return redirect()->route('admin.pengaturan.akun')
                ->with('success', 'Akun admin baru berhasil dibuat!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function createGuru(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'guru_name'     => 'required|string|max:255',
            'guru_nip'      => 'required|string|max:255|unique:users,nip',
            'guru_email'    => 'required|email|max:255|unique:users,email',
            'guru_password' => 'required|string|min:6|confirmed',
        ], [
            'guru_name.required'      => 'Nama guru wajib diisi',
            'guru_nip.required'       => 'NIP guru wajib diisi',
            'guru_nip.unique'         => 'NIP sudah digunakan akun lain',
            'guru_email.required'     => 'Email guru wajib diisi',
            'guru_email.unique'       => 'Email sudah digunakan akun lain',
            'guru_password.required'  => 'Password wajib diisi',
            'guru_password.min'       => 'Password minimal 6 karakter',
            'guru_password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal membuat akun guru: ' . $validator->errors()->first());
        }

        try {
            // Create new guru — nik diisi sama dengan nip agar tidak error NOT NULL
            User::create([
                'name'      => $request->guru_name,
                'nik'       => $request->guru_nip,
                'nip'       => $request->guru_nip,
                'email'     => $request->guru_email,
                'password'  => Hash::make($request->guru_password),
                'role'      => 'guru',
                'is_active' => true,
                'status'    => 'aktif',
            ]);

            return redirect()->route('admin.pengaturan.akun')
                ->with('success', 'Akun guru baru berhasil dibuat!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }
}
