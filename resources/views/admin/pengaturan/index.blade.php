@extends('admin.layouts.app')

@section('title', 'Pengaturan Akun')

@section('content')
<div class="container-fluid px-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1"><i class="bi bi-gear-fill text-primary me-2"></i>Pengaturan Akun</h4>
            <p class="text-muted mb-0 small">Kelola akun Admin dan Guru untuk sistem login</p>
        </div>
        <span class="badge bg-primary px-3 py-2" style="border-radius: 20px;">
            <i class="bi bi-shield-check me-1"></i>Manajemen Akun
        </span>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
            <i class="bi bi-check-circle me-2"></i><strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i><strong>Gagal!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i><strong>Validasi gagal:</strong>
            <ul class="mb-0 mt-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Dua Card: Admin & Guru --}}
    <div class="row g-4 mb-4">

        {{-- Admin Card --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; overflow: hidden;">
                <div class="card-header border-0 py-3 px-4" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                    <div class="d-flex align-items-center gap-3 text-white">
                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                             style="width:42px; height:42px; background: rgba(255,255,255,0.2);">
                            <i class="bi bi-person-badge"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Pengaturan Akun Admin</h6>
                            <small class="opacity-75">Kelola kredensial login administrator</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center mx-auto mb-3"
                             style="width: 80px; height: 80px; font-size: 32px; font-weight: bold;">
                            <span>A</span>
                        </div>
                        <h5 class="fw-bold mb-1">{{ $admin->name ?? 'Admin' }}</h5>
                        <p class="text-muted small mb-0">{{ $admin->email ?? 'admin@example.com' }}</p>
                        <span class="badge bg-success">Aktif</span>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-primary fw-semibold" onclick="showAdminModal()">
                            <i class="bi bi-pencil-square me-2"></i>Ubah Akun Admin
                        </button>
                        <button type="button" class="btn btn-outline-primary fw-semibold" onclick="showCreateAdminModal()">
                            <i class="bi bi-person-plus me-2"></i>Buat Akun Admin Baru
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Guru Card --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; overflow: hidden;">
                <div class="card-header border-0 py-3 px-4" style="background: linear-gradient(135deg, #198754, #146c43);">
                    <div class="d-flex align-items-center gap-3 text-white">
                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                             style="width:42px; height:42px; background: rgba(255,255,255,0.2);">
                            <i class="bi bi-mortarboard"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Pengaturan Akun Guru</h6>
                            <small class="opacity-75">Kelola kredensial login guru</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <div class="rounded-circle bg-success bg-opacity-10 text-success d-inline-flex align-items-center justify-content-center mx-auto mb-3"
                             style="width: 80px; height: 80px; font-size: 32px; font-weight: bold;">
                            <span>G</span>
                        </div>
                        <h5 class="fw-bold mb-1">{{ $guru->name ?? 'Guru' }}</h5>
                        <p class="text-muted small mb-0">{{ $guru->email ?? 'guru@example.com' }}</p>
                        <span class="badge bg-success">Aktif</span>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-success fw-semibold" onclick="showGuruModal()">
                            <i class="bi bi-pencil-square me-2"></i>Ubah Akun Guru
                        </button>
                        <button type="button" class="btn btn-outline-success fw-semibold" onclick="showCreateGuruModal()">
                            <i class="bi bi-person-plus me-2"></i>Buat Akun Guru Baru
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Info Login --}}
    <div class="card border-0 shadow-sm" style="border-radius: 14px; overflow: hidden;">
        <div class="card-header border-0 py-3 px-4" style="background: linear-gradient(135deg, #6366f1, #4f46e5);">
            <div class="d-flex align-items-center gap-3 text-white">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:42px; height:42px; background: rgba(255,255,255,0.2);">
                    <i class="bi bi-info-circle"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-0">Informasi Sistem Login</h6>
                    <small class="opacity-75">Panduan login untuk setiap role pengguna</small>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="card border-0 text-center p-3 h-100" style="background: #eff6ff; border-radius: 12px;">
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mx-auto mb-3"
                             style="width:52px; height:52px;">
                            <i class="bi bi-person-badge"></i>
                        </div>
                        <h6 class="fw-bold text-primary mb-1">Admin</h6>
                        <p class="small text-muted mb-0">Login menggunakan NIP Admin yang diatur di halaman ini</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 text-center p-3 h-100" style="background: #f0fdf4; border-radius: 12px;">
                        <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center mx-auto mb-3"
                             style="width:52px; height:52px;">
                            <i class="bi bi-mortarboard"></i>
                        </div>
                        <h6 class="fw-bold text-success mb-1">Guru</h6>
                        <p class="small text-muted mb-0">Login menggunakan NIP Guru yang diatur di halaman ini</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 text-center p-3 h-100" style="background: #fffbeb; border-radius: 12px;">
                        <div class="rounded-circle bg-warning text-white d-inline-flex align-items-center justify-content-center mx-auto mb-3"
                             style="width:52px; height:52px;">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>
                        <h6 class="fw-bold text-warning mb-1">Siswa</h6>
                        <p class="small text-muted mb-0">Register dan login menggunakan NISN (10 digit)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal Ubah Akun Admin -->
<div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="adminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden; display: flex; flex-direction: column; height: auto; min-height: 500px;">
            <!-- Header -->
            <div class="modal-header" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); border: none;">
                <div class="d-flex align-items-center w-100">
                    <div class="rounded-circle bg-white bg-opacity-25 p-3 me-3">
                        <i class="bi bi-person-badge fs-2 text-white"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="modal-title text-white mb-1" id="adminModalLabel">Ubah Akun Admin</h5>
                        <small class="text-white-50">Perbarui informasi login administrator</small>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            
            <!-- Body -->
            <div class="modal-body p-4" style="flex: 1; overflow-y: auto; display: flex; flex-direction: column;">
                <form action="{{ route('admin.pengaturan.update.admin') }}" method="POST" id="adminForm">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">
                            <i class="bi bi-person text-primary me-1"></i>Nama Lengkap
                        </label>
                        <input type="text" class="form-control" name="admin_name"
                               value="{{ $admin->name ?? 'Admin' }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">
                            <i class="bi bi-badge text-primary me-1"></i>NIP Admin
                        </label>
                        <input type="text" class="form-control" name="admin_nip"
                               value="{{ $admin->nip ?? '' }}" placeholder="Masukkan NIP Admin" required>
                        <div class="form-text">NIP digunakan untuk login administrator</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">
                            <i class="bi bi-envelope text-primary me-1"></i>Email Admin
                        </label>
                        <input type="email" class="form-control" name="admin_email"
                               value="{{ $admin->email ?? 'admin@example.com' }}" required>
                    </div>

                    <hr class="my-3">

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">
                            <i class="bi bi-key text-primary me-1"></i>Password Baru
                        </label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="admin_password"
                                   name="admin_password" placeholder="Kosongkan jika tidak ingin mengubah">
                            <button type="button" class="btn btn-outline-secondary toggle-pw" data-target="admin_password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <div class="form-text">Biarkan kosong jika tidak ingin mengubah password</div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold small">
                            <i class="bi bi-lock text-primary me-1"></i>Konfirmasi Password
                        </label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="admin_password_confirmation"
                                   name="admin_password_confirmation" placeholder="Konfirmasi password baru">
                            <button type="button" class="btn btn-outline-secondary toggle-pw" data-target="admin_password_confirmation">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary fw-semibold">
                            <i class="bi bi-save me-2"></i>Simpan Perubahan Admin
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Footer -->
            <div class="modal-footer border-0" style="flex-shrink: 0; margin-top: auto; padding: 1rem 1.5rem; background-color: #f8f9fa; border-top: 1px solid #dee2e6;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('adminForm').submit()">
                    <i class="bi bi-save me-2"></i>Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ubah Akun Guru -->
<div class="modal fade" id="guruModal" tabindex="-1" aria-labelledby="guruModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden; display: flex; flex-direction: column; height: auto; min-height: 500px;">
            <!-- Header -->
            <div class="modal-header" style="background: linear-gradient(135deg, #198754 0%, #146c43 100%); border: none;">
                <div class="d-flex align-items-center w-100">
                    <div class="rounded-circle bg-white bg-opacity-25 p-3 me-3">
                        <i class="bi bi-mortarboard fs-2 text-white"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="modal-title text-white mb-1" id="guruModalLabel">Ubah Akun Guru</h5>
                        <small class="text-white-50">Perbarui informasi login guru</small>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            
            <!-- Body -->
            <div class="modal-body p-4" style="flex: 1; overflow-y: auto; display: flex; flex-direction: column;">
                <form action="{{ route('admin.pengaturan.update.guru') }}" method="POST" id="guruForm">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">
                            <i class="bi bi-person text-success me-1"></i>Nama Lengkap
                        </label>
                        <input type="text" class="form-control" name="guru_name"
                               value="{{ $guru->name ?? 'Guru' }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">
                            <i class="bi bi-badge text-success me-1"></i>NIP Guru
                        </label>
                        <input type="text" class="form-control" name="guru_nip"
                               value="{{ $guru->nip ?? '' }}" placeholder="Masukkan NIP Guru" required>
                        <div class="form-text">NIP digunakan untuk login guru</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">
                            <i class="bi bi-envelope text-success me-1"></i>Email Guru
                        </label>
                        <input type="email" class="form-control" name="guru_email"
                               value="{{ $guru->email ?? 'guru@example.com' }}" required>
                    </div>
    
                    <hr class="my-3">

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">
                            <i class="bi bi-key text-success me-1"></i>Password Baru
                        </label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="guru_password"
                                   name="guru_password" placeholder="Kosongkan jika tidak ingin mengubah">
                            <button type="button" class="btn btn-outline-secondary toggle-pw" data-target="guru_password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <div class="form-text">Biarkan kosong jika tidak ingin mengubah password</div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold small">
                            <i class="bi bi-lock text-success me-1"></i>Konfirmasi Password
                        </label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="guru_password_confirmation"
                                   name="guru_password_confirmation" placeholder="Konfirmasi password baru">
                            <button type="button" class="btn btn-outline-secondary toggle-pw" data-target="guru_password_confirmation">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success fw-semibold">
                            <i class="bi bi-save me-2"></i>Simpan Perubahan Guru
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Footer -->
            <div class="modal-footer border-0" style="flex-shrink: 0; margin-top: auto; padding: 1rem 1.5rem; background-color: #f8f9fa; border-top: 1px solid #dee2e6;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-success" onclick="document.getElementById('guruForm').submit()">
                    <i class="bi bi-save me-2"></i>Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Buat Akun Admin Baru -->
<div class="modal fade" id="createAdminModal" tabindex="-1" aria-labelledby="createAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden; display: flex; flex-direction: column; height: auto; min-height: 500px;">
            <!-- Header -->
            <div class="modal-header" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); border: none;">
                <div class="d-flex align-items-center w-100">
                    <div class="rounded-circle bg-white bg-opacity-25 p-3 me-3">
                        <i class="bi bi-person-plus fs-2 text-white"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="modal-title text-white mb-1" id="createAdminModalLabel">Buat Akun Admin Baru</h5>
                        <small class="text-white-50">Tambahkan administrator baru ke sistem</small>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            
            <!-- Body -->
            <div class="modal-body p-4" style="flex: 1; overflow-y: auto; display: flex; flex-direction: column;">
                <form action="{{ route('admin.pengaturan.create.admin') }}" method="POST" id="createAdminForm">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">
                            <i class="bi bi-person text-primary me-1"></i>Nama Lengkap
                        </label>
                        <input type="text" class="form-control" name="admin_name"
                               value="" placeholder="Masukkan nama lengkap admin" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">
                            <i class="bi bi-badge text-primary me-1"></i>NIP Admin
                        </label>
                        <input type="text" class="form-control" name="admin_nip"
                               value="" placeholder="Masukkan NIP Admin" required>
                        <div class="form-text">NIP digunakan untuk login administrator</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">
                            <i class="bi bi-envelope text-primary me-1"></i>Email Admin
                        </label>
                        <input type="email" class="form-control" name="admin_email"
                               value="" placeholder="Masukkan email admin" required>
                    </div>

                    <hr class="my-3">

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">
                            <i class="bi bi-key text-primary me-1"></i>Password
                        </label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="create_admin_password"
                                   name="admin_password" value="" placeholder="Masukkan password" required>
                            <button type="button" class="btn btn-outline-secondary toggle-pw" data-target="create_admin_password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold small">
                            <i class="bi bi-lock text-primary me-1"></i>Konfirmasi Password
                        </label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="create_admin_password_confirmation"
                                   name="admin_password_confirmation" value="" placeholder="Konfirmasi password" required>
                            <button type="button" class="btn btn-outline-secondary toggle-pw" data-target="create_admin_password_confirmation">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary fw-semibold">
                            <i class="bi bi-person-plus me-2"></i>Buat Akun Admin
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Footer -->
            <div class="modal-footer border-0" style="flex-shrink: 0; margin-top: auto; padding: 1rem 1.5rem; background-color: #f8f9fa; border-top: 1px solid #dee2e6;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('createAdminForm').submit()">
                    <i class="bi bi-person-plus me-2"></i>Buat
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Buat Akun Guru Baru -->
<div class="modal fade" id="createGuruModal" tabindex="-1" aria-labelledby="createGuruModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden; display: flex; flex-direction: column; height: auto; min-height: 500px;">
            <!-- Header -->
            <div class="modal-header" style="background: linear-gradient(135deg, #198754 0%, #146c43 100%); border: none;">
                <div class="d-flex align-items-center w-100">
                    <div class="rounded-circle bg-white bg-opacity-25 p-3 me-3">
                        <i class="bi bi-person-plus fs-2 text-white"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="modal-title text-white mb-1" id="createGuruModalLabel">Buat Akun Guru Baru</h5>
                        <small class="text-white-50">Tambahkan guru baru ke sistem</small>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            
            <!-- Body -->
            <div class="modal-body p-4" style="flex: 1; overflow-y: auto; display: flex; flex-direction: column;">
                <form action="{{ route('admin.pengaturan.create.guru') }}" method="POST" id="createGuruForm">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">
                            <i class="bi bi-person text-success me-1"></i>Nama Lengkap
                        </label>
                        <input type="text" class="form-control" name="guru_name"
                               value="" placeholder="Masukkan nama lengkap guru" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">
                            <i class="bi bi-badge text-success me-1"></i>NIP Guru
                        </label>
                        <input type="text" class="form-control" name="guru_nip"
                               value="" placeholder="Masukkan NIP Guru" required>
                        <div class="form-text">NIP digunakan untuk login guru</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">
                            <i class="bi bi-envelope text-success me-1"></i>Email Guru
                        </label>
                        <input type="email" class="form-control" name="guru_email"
                               value="" placeholder="Masukkan email guru" required>
                    </div>
    
                    <hr class="my-3">

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">
                            <i class="bi bi-key text-success me-1"></i>Password
                        </label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="create_guru_password"
                                   name="guru_password" value="" placeholder="Masukkan password" required>
                            <button type="button" class="btn btn-outline-secondary toggle-pw" data-target="create_guru_password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold small">
                            <i class="bi bi-lock text-success me-1"></i>Konfirmasi Password
                        </label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="create_guru_password_confirmation"
                                   name="guru_password_confirmation" value="" placeholder="Konfirmasi password" required>
                            <button type="button" class="btn btn-outline-secondary toggle-pw" data-target="create_guru_password_confirmation">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success fw-semibold">
                            <i class="bi bi-person-plus me-2"></i>Buat Akun Guru
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Footer -->
            <div class="modal-footer border-0" style="flex-shrink: 0; margin-top: auto; padding: 1rem 1.5rem; background-color: #f8f9fa; border-top: 1px solid #dee2e6;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-success" onclick="document.getElementById('createGuruForm').submit()">
                    <i class="bi bi-person-plus me-2"></i>Buat
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Toggle show/hide password
    document.querySelectorAll('.toggle-pw').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const input = document.getElementById(this.dataset.target);
            const icon  = this.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        });
    });

    // Show Admin Modal
    function showAdminModal() {
        const modal = new bootstrap.Modal(document.getElementById('adminModal'));
        modal.show();
    }

    // Show Guru Modal
    function showGuruModal() {
        const modal = new bootstrap.Modal(document.getElementById('guruModal'));
        modal.show();
    }

    // Show Create Admin Modal
    function showCreateAdminModal() {
        // Reset form dengan benar — hanya field input user, bukan hidden token
        const form = document.getElementById('createAdminForm');
        form.querySelectorAll('input:not([type="hidden"])').forEach(input => {
            input.value = '';
            input.type = input.id && input.id.includes('password') ? 'password' : input.type;
        });
        const modal = new bootstrap.Modal(document.getElementById('createAdminModal'));
        modal.show();
    }

    // Show Create Guru Modal
    function showCreateGuruModal() {
        // Reset form dengan benar — hanya field input user, bukan hidden token
        const form = document.getElementById('createGuruForm');
        form.querySelectorAll('input:not([type="hidden"])').forEach(input => {
            input.value = '';
            input.type = input.id && input.id.includes('password') ? 'password' : input.type;
        });
        const modal = new bootstrap.Modal(document.getElementById('createGuruModal'));
        modal.show();
    }
</script>
@endpush
