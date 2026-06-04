@extends('admin.layouts.app')

@section('title', 'Daftar Akun Admin')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold text-dark mb-1">
                        <i class="bi bi-people text-primary me-2"></i>Daftar Akun Admin
                    </h2>
                    <p class="text-muted mb-0">Kelola dan lihat semua akun administrator yang terdaftar</p>
                </div>
                <div class="text-end">
                    <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                        <i class="bi bi-shield-check text-primary fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm bg-success bg-opacity-10">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="bg-success bg-opacity-20 rounded-2 p-3 me-3">
                            <i class="bi bi-person-check text-success fs-4"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="fw-bold text-success mb-1">{{ $admins->where('status', 'aktif')->count() }}</h3>
                            <p class="text-success mb-0">Admin Aktif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm bg-warning bg-opacity-10">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="bg-warning bg-opacity-20 rounded-2 p-3 me-3">
                            <i class="bi bi-person-dash text-warning fs-4"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="fw-bold text-warning mb-1">{{ $admins->where('status', 'nonaktif')->count() }}</h3>
                            <p class="text-warning mb-0">Admin Nonaktif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm bg-info bg-opacity-10">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="bg-info bg-opacity-20 rounded-2 p-3 me-3">
                            <i class="bi bi-people text-info fs-4"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="fw-bold text-info mb-1">{{ $admins->count() }}</h3>
                            <p class="text-info mb-0">Total Admin</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert" style="background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                            <i class="bi bi-check-circle text-success"></i>
                        </div>
                        <div class="flex-grow-1">
                            <strong class="text-success">Berhasil!</strong>
                            <div class="text-success small">{{ session('success') }}</div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Admin Table -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-table text-primary me-2"></i>Daftar Administrator
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Admin</th>
                                    <th>NIP</th>
                                    <th>Password</th>
                                    <th>Gmail Admin</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($admins as $admin)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px; font-size: 14px;">
                                                    {{ strtoupper(substr($admin->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <strong>{{ $admin->name }}</strong>
                                                    @if($admin->id === Auth::id())
                                                        <span class="badge bg-primary ms-1">Anda</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $admin->nip ?? '-' }}</td>
                                        <td>
                                            <span class="text-monospace">••••••••</span>
                                            <button class="btn btn-sm btn-link p-0 ms-1" onclick="togglePassword(this)" data-password="{{ $admin->password ?? 'password123' }}">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </td>
                                        <td>{{ $admin->email }}</td>
                                        <td>
                                            @if($admin->status === 'aktif')
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-danger">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-primary" title="Lihat Detail" onclick="showAdminDetail('{{ $admin->id }}', '{{ $admin->name }}', '{{ $admin->nip ?? '' }}', '{{ $admin->email }}', '{{ $admin->password ?? 'password123' }}', '{{ $admin->status ?? 'aktif' }}', '{{ $admin->created_at ?? '' }}', {{ $admin->id === Auth::id() ? 'true' : 'false' }})" style="font-weight: 600; min-width: 80px;">
                                                    <i class="bi bi-eye me-1"></i>Detail
                                                </button>
                                                @if($admin->id !== Auth::id())
                                                    <button type="button" class="btn btn-sm btn-outline-warning" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                                <strong>Belum ada data admin</strong>
                                                <p class="small">Admin yang terdaftar akan muncul di sini</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Admin -->
<div class="modal fade" id="detailAdminModal" tabindex="-1" aria-labelledby="detailAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden; display: flex; flex-direction: column; height: auto; min-height: 400px;">
            <!-- Header -->
            <div class="modal-header" style="background: linear-gradient(135deg, #0084ff 0%, #0051cc 100%); border: none;">
                <div class="d-flex align-items-center w-100">
                    <div class="rounded-circle bg-white bg-opacity-25 p-3 me-3">
                        <i class="bi bi-person-badge fs-2 text-white"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="modal-title text-white mb-1" id="detailAdminModalLabel">Detail Akun Admin</h5>
                        <small class="text-white-50">Informasi lengkap akun administrator</small>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            
            <!-- Body -->
            <div class="modal-body p-4" style="flex: 1; overflow-y: auto; display: flex; flex-direction: column;">
                <div class="row">
                    <!-- Profile Section -->
                    <div class="col-md-4 text-center mb-4">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center mx-auto" style="width: 120px; height: 120px; font-size: 48px; font-weight: bold;">
                            <span id="modalAvatar">A</span>
                        </div>
                        <h4 class="mt-3 mb-1" id="modalNama">Nama Admin</h4>
                        <span class="badge bg-primary" id="modalBadgeAnda">Anda</span>
                        <span class="badge bg-success ms-1" id="modalStatus">Aktif</span>
                    </div>
                    
                    <!-- Info Section -->
                    <div class="col-md-8">
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-body">
                                <h6 class="fw-bold text-primary mb-3">
                                    <i class="bi bi-info-circle me-2"></i>Informasi Pribadi
                                </h6>
                                <div class="row">
                                    <div class="col-sm-4 text-muted">Nama Lengkap:</div>
                                    <div class="col-sm-8 fw-bold" id="modalNamaLengkap">-</div>
                                </div>
                                <hr class="my-2">
                                <div class="row">
                                    <div class="col-sm-4 text-muted">NIP:</div>
                                    <div class="col-sm-8 fw-bold" id="modalNIP">-</div>
                                </div>
                                <hr class="my-2">
                                <div class="row">
                                    <div class="col-sm-4 text-muted">Status:</div>
                                    <div class="col-sm-8">
                                        <span class="badge" id="modalStatusBadge">Aktif</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-body">
                                <h6 class="fw-bold text-primary mb-3">
                                    <i class="bi bi-envelope me-2"></i>Informasi Akun
                                </h6>
                                <div class="row">
                                    <div class="col-sm-4 text-muted">Gmail Admin:</div>
                                    <div class="col-sm-8 fw-bold" id="modalEmail">-</div>
                                </div>
                                <hr class="my-2">
                                <div class="row">
                                    <div class="col-sm-4 text-muted">Password:</div>
                                    <div class="col-sm-8">
                                        <div class="d-flex align-items-center">
                                            <span class="password-text" id="modalPassword">••••••••</span>
                                            <button class="btn btn-sm btn-link p-0 ms-2" onclick="toggleModalPassword()">
                                                <i class="bi bi-eye" id="modalPasswordIcon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-2">
                                <div class="row">
                                    <div class="col-sm-4 text-muted">Tanggal Dibuat:</div>
                                    <div class="col-sm-8 fw-bold" id="modalTanggal">-</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h6 class="fw-bold text-primary mb-3">
                                    <i class="bi bi-shield-check me-2"></i>Keamanan
                                </h6>
                                <div class="row">
                                    <div class="col-sm-4 text-muted">Role:</div>
                                    <div class="col-sm-8 fw-bold">Administrator</div>
                                </div>
                                <hr class="my-2">
                                <div class="row">
                                    <div class="col-sm-4 text-muted">ID User:</div>
                                    <div class="col-sm-8 fw-bold" id="modalUserId">-</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="modal-footer border-0" style="flex-shrink: 0; margin-top: auto; padding: 1rem 1.5rem; background-color: #f8f9fa; border-top: 1px solid #dee2e6;">
                <button type="button" class="btn btn-info" onclick="window.location.href='{{ route('admin.dashboard') }}'">
                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Tutup
                </button>
                <button type="button" class="btn btn-primary" onclick="printDetail()">
                    <i class="bi bi-printer me-2"></i>Cetak
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let currentAdminData = null;

function togglePassword(button) {
    const passwordText = button.previousElementSibling;
    const password = button.getAttribute('data-password');
    const icon = button.querySelector('i');
    
    if (passwordText.textContent === '••••••••') {
        passwordText.textContent = password;
        icon.className = 'bi bi-eye-slash';
    } else {
        passwordText.textContent = '••••••••';
        icon.className = 'bi bi-eye';
    }
}

function toggleModalPassword() {
    const passwordText = document.getElementById('modalPassword');
    const icon = document.getElementById('modalPasswordIcon');
    
    if (passwordText.textContent === '••••••••') {
        passwordText.textContent = currentAdminData.password;
        icon.className = 'bi bi-eye-slash';
    } else {
        passwordText.textContent = '••••••••';
        icon.className = 'bi bi-eye';
    }
}

function showAdminDetail(adminId, nama, nip, email, password, status, createdAt, isCurrentUser) {
    currentAdminData = {
        password: password || 'password123'
    };
    
    // Set avatar
    document.getElementById('modalAvatar').textContent = nama ? nama.charAt(0).toUpperCase() : 'A';
    
    // Set nama
    document.getElementById('modalNama').textContent = nama || '-';
    document.getElementById('modalNamaLengkap').textContent = nama || '-';
    
    // Set badge "Anda"
    const badgeAnda = document.getElementById('modalBadgeAnda');
    if (isCurrentUser) {
        badgeAnda.style.display = 'inline-block';
    } else {
        badgeAnda.style.display = 'none';
    }
    
    // Set NIP
    document.getElementById('modalNIP').textContent = nip || '-';
    
    // Set status
    const statusBadge = document.getElementById('modalStatusBadge');
    const statusText = document.getElementById('modalStatus');
    if (status === 'aktif') {
        statusBadge.className = 'badge bg-success';
        statusBadge.textContent = 'Aktif';
        statusText.className = 'badge bg-success ms-1';
        statusText.textContent = 'Aktif';
    } else {
        statusBadge.className = 'badge bg-danger';
        statusBadge.textContent = 'Nonaktif';
        statusText.className = 'badge bg-danger ms-1';
        statusText.textContent = 'Nonaktif';
    }
    
    // Set email
    document.getElementById('modalEmail').textContent = email || '-';
    
    // Reset password
    document.getElementById('modalPassword').textContent = '••••••••';
    document.getElementById('modalPasswordIcon').className = 'bi bi-eye';
    
    // Set tanggal
    if (createdAt) {
        const date = new Date(createdAt);
        document.getElementById('modalTanggal').textContent = date.toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
    } else {
        document.getElementById('modalTanggal').textContent = '-';
    }
    
    // Set user ID
    document.getElementById('modalUserId').textContent = adminId || '-';
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('detailAdminModal'));
    modal.show();
}

function printDetail() {
    window.print();
}

// Add print styles
const printStyles = document.createElement('style');
printStyles.textContent = `
    @media print {
        body * {
            visibility: hidden;
        }
        #detailAdminModal, #detailAdminModal * {
            visibility: visible;
        }
        #detailAdminModal {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .modal-header, .modal-footer {
            display: none !important;
        }
        .btn {
            display: none !important;
        }
    }
`;
document.head.appendChild(printStyles);
</script>
@endsection
