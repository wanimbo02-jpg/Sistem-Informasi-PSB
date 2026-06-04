<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Dashboard Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\OrangtuaWali\DashboardController as OrangtuaDashboardController;

// Pendaftaran Controllers
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;
use App\Http\Controllers\Siswa\PendaftaranController as SiswaPendaftaranController;
use App\Http\Controllers\Siswa\ProfileController;
use App\Http\Controllers\Siswa\BerkasController;

// Data siswa pendaftaran
use App\Http\Controllers\Siswa\DataPribadi\DataPribadiController;
use App\Http\Controllers\Siswa\DataPribadi\DataPendaftaranController;
use App\Http\Controllers\Siswa\DataPribadi\DataOrtuController;
use App\Http\Controllers\Siswa\DataPribadi\BerkasController as DataPribadiBerkasController;

// Public Controllers
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\VisiMisiController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\InfoController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\BeritaController;
use App\Http\Controllers\Public\GalleryController;
use App\Http\Controllers\EmailVerificationController;

// Admin Controllers
use App\Http\Controllers\Admin\VisiMisi\VisiMisiController as AdminVisiMisiController;

// Guru Controllers
use App\Http\Controllers\Guru\DataSiswaController;
use App\Http\Controllers\Guru\SiswaDiseleksiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ======================
// 1. PUBLIC ROUTES (Tanpa Login)
// ======================
Route::get('/', [HomeController::class, 'index'])->name('home');

// Pengumuman Routes
Route::get('/pengumuman', [HomeController::class, 'pengumumanIndex'])->name('pengumuman.index');
Route::get('/pengumuman/hasil-seleksi', [HomeController::class, 'hasilSeleksi'])->name('pengumuman.hasil-seleksi');
Route::get('/hasil-seleksi', [HomeController::class, 'hasilSeleksi'])->name('hasil-seleksi');
Route::get('/hasil-seleksi/pdf', [HomeController::class, 'downloadPDF'])->name('hasil-seleksi.pdf');
Route::get('/hasil-seleksi/word', [HomeController::class, 'downloadWord'])->name('hasil-seleksi.word');
Route::get('/hasil-seleksi/excel', [HomeController::class, 'downloadExcel'])->name('hasil-seleksi.excel');
Route::get('/tentang', [AboutController::class, 'index'])->name('about');
Route::get('/tentang/sejarah', [AboutController::class, 'sejarah'])->name('about.sejarah');
Route::get('/tentang/visi-misi', [AboutController::class, 'visiMisi'])->name('about.visi-misi');
Route::get('/tentang/struktur', [AboutController::class, 'struktur'])->name('about.struktur');
Route::get('/informasi', [InfoController::class, 'index'])->name('info');
Route::get('/informasi-pendaftaran', [\App\Http\Controllers\Public\InformasiPendaftaranController::class, 'index'])->name('informasi-pendaftaran.index');
Route::get('/informasi-pendaftaran/{id}', [\App\Http\Controllers\Public\InformasiPendaftaranController::class, 'show'])->name('informasi-pendaftaran.show');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');
Route::get('/berita', [BeritaController::class, 'index'])->name('berita');

// Fasilitas Sekolah (Public) - nama berbeda dari admin agar tidak konflik
Route::get('/fasilitas-sekolah', [\App\Http\Controllers\Public\FasilitasController::class, 'index'])->name('fasilitas.publik');

Route::get('/galleries', [GalleryController::class, 'index'])->name('gallery');
Route::get('/galleries/{slug}', [GalleryController::class, 'show'])->name('gallery.show');

// Email Verification Routes
Route::get('/verify-email', [EmailVerificationController::class, 'show'])->name('verify.show');
Route::get('/verify-before-login', [EmailVerificationController::class, 'showBeforeLogin'])->name('verify.before.login');
Route::post('/verify-send', [EmailVerificationController::class, 'send'])->name('verify.send');
Route::post('/verify-code', [EmailVerificationController::class, 'verify'])->name('verify.code');
Route::post('/resend-code', [EmailVerificationController::class, 'resend'])->name('verify.resend');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->middleware('auto_detect_role');

    Route::middleware('hak_akses_register')->group(function () {
        Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [RegisterController::class, 'register'])->middleware('auto_detect_role');
    });

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/pendaftaran-selesai', function () {
    return view('siswa.pendaftaran-selesai');
})->name('pendaftaran.selesai');

// ======================
// 2. PUBLIC CHECK STATUS
// ======================
Route::prefix('siswa')->name('siswa.')->group(function () {
    Route::match(['get', 'post'], '/cek-status', [SiswaPendaftaranController::class, 'cekStatus'])
        ->name('pendaftaran.cek-status');
});

// ======================
// 3. ROUTES DENGAN LOGIN (Auth)
// ======================
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        if (auth()->user()->role == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->role == 'siswa') {
            return redirect()->route('siswa.dashboard');
        } elseif (auth()->user()->role == 'guru') {
            if (\App\Models\HakAkses::isModulAktif('guru')) {
                return redirect()->route('guru.dashboard');
            } else {
                auth()->logout();
                return redirect()->route('login')
                    ->with('error', 'Akses Dashboard Guru sedang dinonaktifkan oleh admin.');
            }
        } elseif (auth()->user()->role == 'orangtua') {
            return redirect()->route('orangtua.dashboard');
        }
        return redirect('/');
    })->name('dashboard');

    // ======================
    // 3.1 ADMIN ROUTES
    // ======================
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Kontak User
        Route::get('/contacts', [App\Http\Controllers\ContactController::class, 'index'])->name('contacts.index');
        Route::get('/contacts/{contact}', [App\Http\Controllers\ContactController::class, 'show'])->name('contacts.show');
        Route::get('/contacts/{contact}/data', [App\Http\Controllers\ContactController::class, 'getData'])->name('contacts.data');
        Route::post('/contacts/{contact}/reply', [App\Http\Controllers\ContactController::class, 'reply'])->name('contacts.reply');
        Route::delete('/contacts/{contact}', [App\Http\Controllers\ContactController::class, 'destroy'])->name('contacts.destroy');
        Route::post('/contacts/mark-read', [App\Http\Controllers\ContactController::class, 'markAsReadMultiple'])->name('contacts.mark-read');
        Route::post('/contacts/delete-multiple', [App\Http\Controllers\ContactController::class, 'deleteMultiple'])->name('contacts.delete-multiple');

        // Visi Misi
        Route::get('/visi-misi', [AdminVisiMisiController::class, 'index'])->name('visi-misi.index');
        Route::get('/visi-misi/create', [AdminVisiMisiController::class, 'create'])->name('visi-misi.create');
        Route::post('/visi-misi', [AdminVisiMisiController::class, 'store'])->name('visi-misi.store');
        Route::get('/visi-misi/{id}/edit', [AdminVisiMisiController::class, 'edit'])->name('visi-misi.edit');
        Route::put('/visi-misi/{id}', [AdminVisiMisiController::class, 'update'])->name('visi-misi.update');
        Route::delete('/visi-misi/{id}', [AdminVisiMisiController::class, 'destroy'])->name('visi-misi.destroy');

        // Pendaftaran
        Route::resource('pendaftaran', AdminPendaftaranController::class);
        Route::post('/pendaftaran/{id}/verifikasi', [AdminPendaftaranController::class, 'verifikasi'])->name('pendaftaran.verifikasi');
        Route::post('/pendaftaran/{id}/kelulusan', [AdminPendaftaranController::class, 'updateKelulusan'])->name('pendaftaran.kelulusan');

        // Seleksi Administrasi Admin
        Route::get('/seleksi-administrasi', [\App\Http\Controllers\Admin\SeleksiAdministrasiController::class, 'index'])->name('seleksi-administrasi.index');
        Route::get('/seleksi-administrasi/{id}', [\App\Http\Controllers\Admin\SeleksiAdministrasiController::class, 'show'])->name('seleksi-administrasi.show');
        Route::put('/seleksi-administrasi/{id}', [\App\Http\Controllers\Admin\SeleksiAdministrasiController::class, 'update'])->name('seleksi-administrasi.update');
        Route::delete('/seleksi-administrasi/{id}', [\App\Http\Controllers\Admin\SeleksiAdministrasiController::class, 'destroy'])->name('seleksi-administrasi.destroy');
        Route::post('/pendaftaran/{id}/status', [AdminPendaftaranController::class, 'updateStatus'])->name('pendaftaran.status');
        Route::get('/pendaftaran/export/data', [AdminPendaftaranController::class, 'export'])->name('pendaftaran.export');
        Route::post('/pendaftaran/export/process', [AdminPendaftaranController::class, 'exportProcess'])->name('pendaftaran.export.process');

        // Informasi
        Route::get('/informasi', [\App\Http\Controllers\Admin\InformasiController::class, 'index'])->name('informasi.index');
        Route::get('/informasi/create', [\App\Http\Controllers\Admin\InformasiController::class, 'create'])->name('informasi.create');
        Route::post('/informasi', [\App\Http\Controllers\Admin\InformasiController::class, 'store'])->name('informasi.store');
        Route::get('/informasi/{id}', [\App\Http\Controllers\Admin\InformasiController::class, 'show'])->name('informasi.show');
        Route::get('/informasi/{id}/edit', [\App\Http\Controllers\Admin\InformasiController::class, 'edit'])->name('informasi.edit');
        Route::put('/informasi/{id}', [\App\Http\Controllers\Admin\InformasiController::class, 'update'])->name('informasi.update');
        Route::delete('/informasi/{id}', [\App\Http\Controllers\Admin\InformasiController::class, 'destroy'])->name('informasi.destroy');

        // Gallery
        Route::get('/gallery', [\App\Http\Controllers\Admin\GalleryController::class, 'index'])->name('gallery.index');
        Route::get('/gallery/create', [\App\Http\Controllers\Admin\GalleryController::class, 'create'])->name('gallery.create');
        Route::post('/gallery', [\App\Http\Controllers\Admin\GalleryController::class, 'store'])->name('gallery.store');
        Route::get('/gallery/{gallery}', [\App\Http\Controllers\Admin\GalleryController::class, 'show'])->name('gallery.show');
        Route::get('/gallery/{gallery}/edit', [\App\Http\Controllers\Admin\GalleryController::class, 'edit'])->name('gallery.edit');
        Route::put('/gallery/{gallery}', [\App\Http\Controllers\Admin\GalleryController::class, 'update'])->name('gallery.update');
        Route::delete('/gallery/{gallery}', [\App\Http\Controllers\Admin\GalleryController::class, 'destroy'])->name('gallery.destroy');

        // Fasilitas (Admin CRUD)
        Route::get('/fasilitas', [\App\Http\Controllers\Admin\FasilitasController::class, 'index'])->name('fasilitas.index');
        Route::get('/fasilitas/create', [\App\Http\Controllers\Admin\FasilitasController::class, 'create'])->name('fasilitas.create');
        Route::post('/fasilitas', [\App\Http\Controllers\Admin\FasilitasController::class, 'store'])->name('fasilitas.store');
        Route::get('/fasilitas/{fasilitas}', [\App\Http\Controllers\Admin\FasilitasController::class, 'show'])->name('fasilitas.show');
        Route::get('/fasilitas/{fasilitas}/edit', [\App\Http\Controllers\Admin\FasilitasController::class, 'edit'])->name('fasilitas.edit');
        Route::put('/fasilitas/{fasilitas}', [\App\Http\Controllers\Admin\FasilitasController::class, 'update'])->name('fasilitas.update');
        Route::delete('/fasilitas/{fasilitas}', [\App\Http\Controllers\Admin\FasilitasController::class, 'destroy'])->name('fasilitas.destroy');

        // Hak Akses
        Route::get('/hak-akses', [\App\Http\Controllers\Admin\HakAksesController::class, 'index'])->name('hak-akses.index');
        Route::put('/hak-akses/{id}', [\App\Http\Controllers\Admin\HakAksesController::class, 'update'])->name('hak-akses.update');
        Route::post('/hak-akses/toggle/{id}', [\App\Http\Controllers\Admin\HakAksesController::class, 'toggle'])->name('hak-akses.toggle');

        // Profile Admin
        Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile.index');

        // Struktur Organisasi Admin
        Route::get('/struktur-organisasi', [\App\Http\Controllers\Admin\StrukturOrganisasi\StrukturOrganisasiController::class, 'index'])->name('struktur-organisasi.index');
        Route::get('/struktur-organisasi/create', [\App\Http\Controllers\Admin\StrukturOrganisasi\StrukturOrganisasiController::class, 'create'])->name('struktur-organisasi.create');
        Route::post('/struktur-organisasi', [\App\Http\Controllers\Admin\StrukturOrganisasi\StrukturOrganisasiController::class, 'store'])->name('struktur-organisasi.store');
        Route::get('/struktur-organisasi/{id}/edit', [\App\Http\Controllers\Admin\StrukturOrganisasi\StrukturOrganisasiController::class, 'edit'])->name('struktur-organisasi.edit');
        Route::put('/struktur-organisasi/{id}', [\App\Http\Controllers\Admin\StrukturOrganisasi\StrukturOrganisasiController::class, 'update'])->name('struktur-organisasi.update');
        Route::delete('/struktur-organisasi/{id}', [\App\Http\Controllers\Admin\StrukturOrganisasi\StrukturOrganisasiController::class, 'destroy'])->name('struktur-organisasi.destroy');

        // Pengaturan Akun
        Route::get('/pengaturan-akun', [\App\Http\Controllers\Admin\PengaturanAkunController::class, 'index'])->name('pengaturan.akun');
        Route::put('/pengaturan/update/admin', [\App\Http\Controllers\Admin\PengaturanAkunController::class, 'updateAdmin'])->name('pengaturan.update.admin');
        Route::put('/pengaturan/update/guru', [\App\Http\Controllers\Admin\PengaturanAkunController::class, 'updateGuru'])->name('pengaturan.update.guru');
        Route::post('/pengaturan/create/admin', [\App\Http\Controllers\Admin\PengaturanAkunController::class, 'createAdmin'])->name('pengaturan.create.admin');
        Route::post('/pengaturan/create/guru', [\App\Http\Controllers\Admin\PengaturanAkunController::class, 'createGuru'])->name('pengaturan.create.guru');
    });

    // ======================
    // 3.2 GURU ROUTES
    // ======================
    Route::prefix('guru')->name('guru.')->middleware(['auth', 'role:guru'])->group(function () {
        Route::middleware('hak_akses:guru')->group(function () {
            Route::get('/dashboard', [App\Http\Controllers\Guru\DashboardController::class, 'index'])->name('dashboard');
        });
        Route::get('/pendaftaran/{id}', [App\Http\Controllers\Guru\DashboardController::class, 'show'])->name('show');
        Route::post('/pendaftaran/{id}/status', [App\Http\Controllers\Guru\DashboardController::class, 'updateStatus'])->name('status');
        Route::post('/guru/pendaftaran/{id}/status', [App\Http\Controllers\Guru\DashboardController::class, 'updateStatus'])->name('guru.status');
        Route::get('/data-siswa', [App\Http\Controllers\Guru\DataSiswaController::class, 'index'])->name('data-siswa.index');
        Route::get('/data-siswa/{id}', [App\Http\Controllers\Guru\DataSiswaController::class, 'show'])->name('data-siswa.show');
        Route::get('/data-siswa/{id}/edit', [App\Http\Controllers\Guru\DataSiswaController::class, 'edit'])->name('data-siswa.edit');
        Route::put('/data-siswa/{id}', [App\Http\Controllers\Guru\DataSiswaController::class, 'update'])->name('data-siswa.update');
        Route::delete('/data-siswa/{id}', [App\Http\Controllers\Guru\DataSiswaController::class, 'destroy'])->name('data-siswa.destroy');
        Route::get('/data-siswa/export/{format}', [App\Http\Controllers\Guru\DataSiswaController::class, 'export'])->name('data-siswa.export');
        Route::get('/siswa-diseleksi', [App\Http\Controllers\Guru\DataSiswaController::class, 'siswaDiseleksi'])->name('siswa-diseleksi.index');
        Route::put('/siswa-diseleksi/{id}', [App\Http\Controllers\Guru\DataSiswaController::class, 'updateSiswaDiseleksi'])->name('siswa-diseleksi.update');
        Route::delete('/siswa-diseleksi/{id}', [App\Http\Controllers\Guru\DataSiswaController::class, 'destroySiswaDiseleksi'])->name('siswa-diseleksi.destroy');
        Route::post('/siswa-diseleksi/update-all', [App\Http\Controllers\Guru\DataSiswaController::class, 'updateAllToUser'])->name('siswa-diseleksi.update-all');
        Route::get('/siswa-diseleksi/export/{format}', [App\Http\Controllers\Guru\DataSiswaController::class, 'exportSiswaDiseleksi'])->name('siswa-diseleksi.export');
        Route::get('/seleksi-administrasi', [App\Http\Controllers\Guru\DataSiswaController::class, 'seleksiAdministrasi'])->name('seleksi-administrasi.index');
        Route::get('/data-kelas', [App\Http\Controllers\Guru\DataKelasController::class, 'index'])->name('data-kelas.index');
        Route::get('/data-kelas/create', [App\Http\Controllers\Guru\DataKelasController::class, 'create'])->name('data-kelas.create');
        Route::post('/data-kelas', [App\Http\Controllers\Guru\DataKelasController::class, 'store'])->name('data-kelas.store');
        Route::get('/data-kelas/{id}', [App\Http\Controllers\Guru\DataKelasController::class, 'show'])->name('data-kelas.show');
        Route::get('/data-kelas/{id}/edit', [App\Http\Controllers\Guru\DataKelasController::class, 'edit'])->name('data-kelas.edit');
        Route::put('/data-kelas/{id}', [App\Http\Controllers\Guru\DataKelasController::class, 'update'])->name('data-kelas.update');
        Route::delete('/data-kelas/{id}', [App\Http\Controllers\Guru\DataKelasController::class, 'destroy'])->name('data-kelas.destroy');
        Route::get('/data-mata-pelajaran', [App\Http\Controllers\Guru\DataMataPelajaranController::class, 'index'])->name('data-mata-pelajaran.index');
        Route::get('/data-mata-pelajaran/create', [App\Http\Controllers\Guru\DataMataPelajaranController::class, 'create'])->name('data-mata-pelajaran.create');
        Route::post('/data-mata-pelajaran', [App\Http\Controllers\Guru\DataMataPelajaranController::class, 'store'])->name('data-mata-pelajaran.store');
        Route::get('/data-mata-pelajaran/{id}', [App\Http\Controllers\Guru\DataMataPelajaranController::class, 'show'])->name('data-mata-pelajaran.show');
        Route::get('/data-mata-pelajaran/{id}/edit', [App\Http\Controllers\Guru\DataMataPelajaranController::class, 'edit'])->name('data-mata-pelajaran.edit');
        Route::put('/data-mata-pelajaran/{id}', [App\Http\Controllers\Guru\DataMataPelajaranController::class, 'update'])->name('data-mata-pelajaran.update');
        Route::delete('/data-mata-pelajaran/{id}', [App\Http\Controllers\Guru\DataMataPelajaranController::class, 'destroy'])->name('data-mata-pelajaran.destroy');
        Route::get('/data-orang-tua', [App\Http\Controllers\Guru\DataOrangTuaController::class, 'index'])->name('data-orang-tua.index');
        Route::get('/data-orang-tua/{id}', [App\Http\Controllers\Guru\DataOrangTuaController::class, 'show'])->name('data-orang-tua.show');
        // Profile Guru
        Route::get('/profile', [\App\Http\Controllers\Guru\ProfileController::class, 'index'])->name('profile.index');

        Route::prefix('data-guru')->name('data-guru.')->group(function () {
            Route::get('/', [App\Http\Controllers\Guru\DataGuruController::class, 'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\Guru\DataGuruController::class, 'create'])->name('create');
            Route::post('/', [App\Http\Controllers\Guru\DataGuruController::class, 'store'])->name('store');
            Route::get('/{id}', [App\Http\Controllers\Guru\DataGuruController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [App\Http\Controllers\Guru\DataGuruController::class, 'edit'])->name('edit');
            Route::put('/{id}', [App\Http\Controllers\Guru\DataGuruController::class, 'update'])->name('update');
            Route::delete('/{id}', [App\Http\Controllers\Guru\DataGuruController::class, 'destroy'])->name('destroy');
        });

        // Pengumuman
        Route::get('/pengumuman', [App\Http\Controllers\Guru\PengumumanController::class, 'index'])->name('pengumuman.index');
        Route::get('/pengumuman/create', [App\Http\Controllers\Guru\PengumumanController::class, 'create'])->name('pengumuman.create');
        Route::post('/pengumuman', [App\Http\Controllers\Guru\PengumumanController::class, 'store'])->name('pengumuman.store');
        Route::get('/pengumuman/{id}/edit', [App\Http\Controllers\Guru\PengumumanController::class, 'edit'])->name('pengumuman.edit');
        Route::put('/pengumuman/{id}', [App\Http\Controllers\Guru\PengumumanController::class, 'update'])->name('pengumuman.update');
    });

    // ======================
    // 3.3 ORANG TUA ROUTES
    // ======================
    Route::middleware(['role:orangtua'])->prefix('orangtua')->name('orangtua.')->group(function () {
        Route::get('/dashboard', [OrangtuaDashboardController::class, 'index'])->name('dashboard');
    });

    // ======================
    // 3.4 SISWA ROUTES
    // ======================
    Route::middleware(['role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');
        Route::prefix('pendaftaran')->name('pendaftaran.')->group(function () {
            Route::get('/', [SiswaPendaftaranController::class, 'index'])->name('index');
            Route::get('/formulir', [SiswaPendaftaranController::class, 'formulir'])->name('formulir');
            Route::get('/create', [SiswaPendaftaranController::class, 'create'])->name('create');
            Route::post('/store', [SiswaPendaftaranController::class, 'store'])->name('store');
            Route::get('/status', [SiswaPendaftaranController::class, 'status'])->name('status');
            Route::get('/sukses', [SiswaPendaftaranController::class, 'sukses'])->name('sukses');
            Route::get('/detail', [SiswaPendaftaranController::class, 'detail'])->name('detail');
            Route::get('/{id}', [SiswaPendaftaranController::class, 'show'])->name('show');
            Route::get('/edit/{id}', [SiswaPendaftaranController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [SiswaPendaftaranController::class, 'update'])->name('update');
            Route::get('/cetak-kartu', [SiswaPendaftaranController::class, 'cetakKartu'])->name('cetak-kartu');
            Route::get('/cetak/{id}', [SiswaPendaftaranController::class, 'cetakFormulir'])->name('cetak');
            Route::get('/download/{id}/{file}', [SiswaPendaftaranController::class, 'downloadFile'])->name('download');
            Route::get('/{id}/download', [SiswaPendaftaranController::class, 'downloadKartu'])->name('download-kartu');
            Route::post('/{id}/upload-berkas', [SiswaPendaftaranController::class, 'uploadBerkas'])->name('upload-berkas');
            Route::delete('/batal/{id}', [SiswaPendaftaranController::class, 'batal'])->name('batal');
        });
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'index'])->name('index');
            Route::get('/create', [ProfileController::class, 'create'])->name('create');
            Route::post('/', [ProfileController::class, 'store'])->name('store');
            Route::get('/show/{id?}', [ProfileController::class, 'show'])->name('show');
            Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
            Route::put('/', [ProfileController::class, 'update'])->name('update');
            Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
            Route::post('/update-foto', [ProfileController::class, 'updateFoto'])->name('update-foto');
            Route::get('/get-data', [ProfileController::class, 'getData'])->name('get-data');
        });
        Route::prefix('data-pribadi')->name('data-pribadi.')->group(function () {
            Route::get('/', [App\Http\Controllers\Siswa\DataPribadi\DataPribadiController::class, 'index'])->name('index');
            Route::post('/', [App\Http\Controllers\Siswa\DataPribadi\DataPribadiController::class, 'store'])->name('store');
            Route::get('/edit', [App\Http\Controllers\Siswa\DataPribadi\DataPribadiController::class, 'edit'])->name('edit');
            Route::put('/', [App\Http\Controllers\Siswa\DataPribadi\DataPribadiController::class, 'update'])->name('update');
        });
        Route::prefix('data-pendaftaran')->name('data-pendaftaran.')->group(function () {
            Route::get('/', [DataPendaftaranController::class, 'index'])->name('index');
            Route::post('/', [DataPendaftaranController::class, 'store'])->name('store');
        });
        Route::prefix('data-orang-tua')->name('data-ortu.')->group(function () {
            Route::get('/', [DataOrtuController::class, 'index'])->name('index');
            Route::post('/', [DataOrtuController::class, 'store'])->name('store');
        });
        Route::prefix('berkas')->name('berkas.')->group(function () {
            Route::get('/', [DataPribadiBerkasController::class, 'index'])->name('index');
            Route::post('/', [DataPribadiBerkasController::class, 'store'])->name('store');
        });
        Route::get('/selesai', [App\Http\Controllers\Siswa\SelesaiController::class, 'index'])->name('selesai');
    });
});
