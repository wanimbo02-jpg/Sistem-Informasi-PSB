@extends('admin.layouts.app')

@section('title', 'Pengaturan Akun')

@section('content')
<div class="container-fluid px-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1"><i class="fas fa-cogs text-primary me-2"></i>Pengaturan Akun</h4>
            <p class="text-muted mb-0 small">Kelola akun Admin dan Guru untuk sistem login</p>
        </div>
        <span class="badge bg-primary px-3 py-2" style="border-radius: 20px;">
            <i class="fas fa-shield-alt me-1"></i>Manajemen Akun
        </span>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i><strong>Berhasil!</strong> {{ session('success') }}
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
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Pengaturan Akun Admin</h6>
                            <small class="opacity-75">Kelola kredensial login administrator</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.pengaturan.update.admin') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                <i class="fas fa-user text-primary me-1"></i>Nama Lengkap
                            </label>
                            <input type="text" class="form-control" name="admin_name"
                                   value="{{ $admin->name ?? '' }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                <i class="fas fa-id-badge text-primary me-1"></i>NIP Admin
                            </label>
                            <input type="text" class="form-control" name="admin_nip"
                                   value="{{ $admin->nip ?? '' }}" placeholder="Masukkan NIP Admin" required>
                            <div class="form-text">NIP digunakan untuk login administrator</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                <i class="fas fa-envelope text-primary me-1"></i>Email Admin
                            </label>
                            <input type="email" class="form-control" name="admin_email"
                                   value="{{ $admin->email ?? '' }}" required>
                        </div>

                        <hr class="my-3">

                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                <i class="fas fa-key text-primary me-1"></i>Password Baru
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="admin_password"
                                       name="admin_password" placeholder="Kosongkan jika tidak ingin mengubah">
                                <button type="button" class="btn btn-outline-secondary toggle-pw" data-target="admin_password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="form-text">Biarkan kosong jika tidak ingin mengubah password</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold small">
                                <i class="fas fa-lock text-primary me-1"></i>Konfirmasi Password
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="admin_password_confirmation"
                                       name="admin_password_confirmation" placeholder="Konfirmasi password baru">
                                <button type="button" class="btn btn-outline-secondary toggle-pw" data-target="admin_password_confirmation">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary fw-semibold">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan Admin
                            </button>
                        </div>
                    </form>
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
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Pengaturan Akun Guru</h6>
                            <small class="opacity-75">Kelola kredensial login guru</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.pengaturan.update.guru') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                <i class="fas fa-user text-success me-1"></i>Nama Lengkap
                            </label>
                            <input type="text" class="form-control" name="guru_name"
                                   value="{{ $guru->name ?? '' }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                <i class="fas fa-id-badge text-success me-1"></i>NIP Guru
                            </label>
                            <input type="text" class="form-control" name="guru_nip"
                                   value="{{ $guru->nip ?? '' }}" placeholder="Masukkan NIP Guru" required>
                            <div class="form-text">NIP digunakan untuk login guru</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                <i class="fas fa-envelope text-success me-1"></i>Email Guru
                            </label>
                            <input type="email" class="form-control" name="guru_email"
                                   value="{{ $guru->email ?? '' }}" required>
                        </div>
    
                        <hr class="my-3">

                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                <i class="fas fa-key text-success me-1"></i>Password Baru
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="guru_password"
                                       name="guru_password" placeholder="Kosongkan jika tidak ingin mengubah">
                                <button type="button" class="btn btn-outline-secondary toggle-pw" data-target="guru_password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="form-text">Biarkan kosong jika tidak ingin mengubah password</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold small">
                                <i class="fas fa-lock text-success me-1"></i>Konfirmasi Password
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="guru_password_confirmation"
                                       name="guru_password_confirmation" placeholder="Konfirmasi password baru">
                                <button type="button" class="btn btn-outline-secondary toggle-pw" data-target="guru_password_confirmation">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success fw-semibold">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan Guru
                            </button>
                        </div>
                    </form>
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
                    <i class="fas fa-info-circle"></i>
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
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <h6 class="fw-bold text-primary mb-1">Admin</h6>
                        <p class="small text-muted mb-0">Login menggunakan NIP Admin yang diatur di halaman ini</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 text-center p-3 h-100" style="background: #f0fdf4; border-radius: 12px;">
                        <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center mx-auto mb-3"
                             style="width:52px; height:52px;">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h6 class="fw-bold text-success mb-1">Guru</h6>
                        <p class="small text-muted mb-0">Login menggunakan NIP Guru yang diatur di halaman ini</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 text-center p-3 h-100" style="background: #fffbeb; border-radius: 12px;">
                        <div class="rounded-circle bg-warning text-white d-inline-flex align-items-center justify-content-center mx-auto mb-3"
                             style="width:52px; height:52px;">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h6 class="fw-bold text-warning mb-1">Siswa</h6>
                        <p class="small text-muted mb-0">Register dan login menggunakan NISN (10 digit)</p>
                    </div>
                </div>
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
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    });
</script>
@endpush
