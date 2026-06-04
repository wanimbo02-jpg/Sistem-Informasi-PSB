@extends('guru.layouts.app')

@section('title', 'Daftar Akun Guru')

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold text-dark mb-1">
                        <i class="bi bi-people text-success me-2"></i>Daftar Akun Guru
                    </h2>
                    <p class="text-muted mb-0">Lihat semua akun guru yang terdaftar dalam sistem</p>
                </div>
                <div class="text-end">
                    <div class="bg-success bg-opacity-10 rounded-3 p-3">
                        <i class="bi bi-person-badge text-success fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm bg-success bg-opacity-10">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="bg-success bg-opacity-20 rounded-2 p-3 me-3">
                            <i class="bi bi-person-check text-success fs-4"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="fw-bold text-success mb-1">
                                {{ $gurus->filter(fn($g) => $g->status === 'aktif' || $g->is_active)->count() }}
                            </h3>
                            <p class="text-success mb-0">Guru Aktif</p>
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
                            <h3 class="fw-bold text-warning mb-1">
                                {{ $gurus->filter(fn($g) => $g->status === 'nonaktif' && !$g->is_active)->count() }}
                            </h3>
                            <p class="text-warning mb-0">Guru Nonaktif</p>
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
                            <h3 class="fw-bold text-info mb-1">{{ $gurus->count() }}</h3>
                            <p class="text-info mb-0">Total Guru</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert"
                    style="background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);">
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

    {{-- Tabel Guru --}}
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-table text-success me-2"></i>Daftar Guru
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Guru</th>
                                    <th>NIP</th>
                                    <th>Password</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($gurus as $guru)
                                    @php
                                        $isAktif = $guru->status === 'aktif' || $guru->is_active;
                                        $statusStr = $isAktif ? 'aktif' : 'nonaktif';
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center me-2 fw-bold"
                                                    style="width: 35px; height: 35px; font-size: 14px;">
                                                    {{ strtoupper(substr($guru->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <strong>{{ $guru->name }}</strong>
                                                    @if($guru->id === Auth::id())
                                                        <span class="badge bg-success ms-1">Anda</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $guru->nip ?? '-' }}</td>
                                        <td>
                                            <span class="pw-mask">••••••••</span>
                                            <button class="btn btn-sm btn-link p-0 ms-1"
                                                onclick="togglePassword(this)"
                                                data-password="{{ $guru->password }}">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </td>
                                        <td>{{ $guru->email }}</td>
                                        <td>
                                            @if($isAktif)
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-danger">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success fw-semibold"
                                                style="min-width: 80px;"
                                                onclick="showGuruDetail(
                                                    '{{ $guru->id }}',
                                                    '{{ addslashes($guru->name) }}',
                                                    '{{ $guru->nip ?? '' }}',
                                                    '{{ $guru->email }}',
                                                    '{{ $guru->password }}',
                                                    '{{ $statusStr }}',
                                                    '{{ $guru->created_at ?? '' }}',
                                                    {{ $guru->id === Auth::id() ? 'true' : 'false' }}
                                                )">
                                                <i class="bi bi-eye me-1"></i>Detail
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                                <strong>Belum ada data guru</strong>
                                                <p class="small mb-0">Akun guru yang terdaftar akan muncul di sini</p>
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

{{-- Print Style --}}
<style>
@media print {
    body * { visibility: hidden; }
    #detailGuruModal, #detailGuruModal * { visibility: visible; }
    #detailGuruModal { position: absolute; left: 0; top: 0; width: 100%; }
    .modal-header, .modal-footer, .btn { display: none !important; }
}
</style>

{{-- Modal Detail Guru --}}
<div class="modal fade" id="detailGuruModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">

            {{-- Header --}}
            <div class="modal-header border-0"
                style="background: linear-gradient(135deg, #28a745 0%, #155724 100%);">
                <div class="d-flex align-items-center w-100">
                    <div class="rounded-circle bg-white bg-opacity-25 p-3 me-3">
                        <i class="bi bi-person-badge fs-2 text-white"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="modal-title text-white mb-1">Detail Akun Guru</h5>
                        <small class="text-white-50">Informasi lengkap akun guru</small>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
            </div>

            {{-- Body --}}
            <div class="modal-body p-4">
                <div class="row">
                    {{-- Avatar --}}
                    <div class="col-md-4 text-center mb-4">
                        <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center mx-auto fw-bold"
                            style="width: 120px; height: 120px; font-size: 48px;">
                            <span id="modalAvatar">G</span>
                        </div>
                        <h4 class="mt-3 mb-1" id="modalNama">Nama Guru</h4>
                        <span class="badge bg-success" id="modalBadgeAnda" style="display:none;">Anda</span>
                        <span class="badge bg-success ms-1" id="modalStatus">Aktif</span>
                    </div>

                    {{-- Info --}}
                    <div class="col-md-8">
                        {{-- Informasi Pribadi --}}
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-body">
                                <h6 class="fw-bold text-success mb-3">
                                    <i class="bi bi-info-circle me-2"></i>Informasi Pribadi
                                </h6>
                                <div class="row mb-2">
                                    <div class="col-sm-4 text-muted">Nama Lengkap</div>
                                    <div class="col-sm-8 fw-bold" id="modalNamaLengkap">-</div>
                                </div>
                                <hr class="my-2">
                                <div class="row mb-2">
                                    <div class="col-sm-4 text-muted">NIP</div>
                                    <div class="col-sm-8 fw-bold" id="modalNIP">-</div>
                                </div>
                                <hr class="my-2">
                                <div class="row">
                                    <div class="col-sm-4 text-muted">Status</div>
                                    <div class="col-sm-8">
                                        <span class="badge" id="modalStatusBadge">Aktif</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Informasi Akun --}}
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-body">
                                <h6 class="fw-bold text-success mb-3">
                                    <i class="bi bi-envelope me-2"></i>Informasi Akun
                                </h6>
                                <div class="row mb-2">
                                    <div class="col-sm-4 text-muted">Email</div>
                                    <div class="col-sm-8 fw-bold" id="modalEmail">-</div>
                                </div>
                                <hr class="my-2">
                                <div class="row mb-2">
                                    <div class="col-sm-4 text-muted">Password</div>
                                    <div class="col-sm-8">
                                        <div class="d-flex align-items-center">
                                            <span id="modalPassword">••••••••</span>
                                            <button class="btn btn-sm btn-link p-0 ms-2"
                                                onclick="toggleModalPassword()">
                                                <i class="bi bi-eye" id="modalPasswordIcon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-2">
                                <div class="row">
                                    <div class="col-sm-4 text-muted">Tanggal Dibuat</div>
                                    <div class="col-sm-8 fw-bold" id="modalTanggal">-</div>
                                </div>
                            </div>
                        </div>

                        {{-- Keamanan --}}
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h6 class="fw-bold text-success mb-3">
                                    <i class="bi bi-shield-check me-2"></i>Keamanan
                                </h6>
                                <div class="row mb-2">
                                    <div class="col-sm-4 text-muted">Role</div>
                                    <div class="col-sm-8 fw-bold">Guru</div>
                                </div>
                                <hr class="my-2">
                                <div class="row">
                                    <div class="col-sm-4 text-muted">ID User</div>
                                    <div class="col-sm-8 fw-bold" id="modalUserId">-</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="modal-footer border-0"
                style="background-color: #f8f9fa; border-top: 1px solid #dee2e6 !important;">
                <button type="button" class="btn btn-success"
                    onclick="window.location.href='{{ route('guru.dashboard') }}'">
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
@endsection

@section('scripts')
<script>
let currentGuruData = null;

function togglePassword(btn) {
    const span = btn.previousElementSibling;
    const pw   = btn.getAttribute('data-password');
    const icon = btn.querySelector('i');
    if (span.textContent === '••••••••') {
        span.textContent = pw;
        icon.className = 'bi bi-eye-slash';
    } else {
        span.textContent = '••••••••';
        icon.className = 'bi bi-eye';
    }
}

function toggleModalPassword() {
    const span = document.getElementById('modalPassword');
    const icon = document.getElementById('modalPasswordIcon');
    if (span.textContent === '••••••••') {
        span.textContent = currentGuruData.password;
        icon.className = 'bi bi-eye-slash';
    } else {
        span.textContent = '••••••••';
        icon.className = 'bi bi-eye';
    }
}

function showGuruDetail(id, nama, nip, email, password, status, createdAt, isCurrentUser) {
    currentGuruData = { password: password || '••••••••' };

    document.getElementById('modalAvatar').textContent      = nama ? nama.charAt(0).toUpperCase() : 'G';
    document.getElementById('modalNama').textContent        = nama || '-';
    document.getElementById('modalNamaLengkap').textContent = nama || '-';
    document.getElementById('modalNIP').textContent         = nip  || '-';
    document.getElementById('modalEmail').textContent       = email || '-';
    document.getElementById('modalUserId').textContent      = id   || '-';

    // Badge "Anda"
    document.getElementById('modalBadgeAnda').style.display = isCurrentUser ? 'inline-block' : 'none';

    // Status
    const badge = document.getElementById('modalStatusBadge');
    const text  = document.getElementById('modalStatus');
    if (status === 'aktif') {
        badge.className = 'badge bg-success'; badge.textContent = 'Aktif';
        text.className  = 'badge bg-success ms-1'; text.textContent = 'Aktif';
    } else {
        badge.className = 'badge bg-danger'; badge.textContent = 'Nonaktif';
        text.className  = 'badge bg-danger ms-1'; text.textContent = 'Nonaktif';
    }

    // Reset password
    document.getElementById('modalPassword').textContent    = '••••••••';
    document.getElementById('modalPasswordIcon').className  = 'bi bi-eye';

    // Tanggal
    document.getElementById('modalTanggal').textContent = createdAt
        ? new Date(createdAt).toLocaleDateString('id-ID', { day:'numeric', month:'long', year:'numeric' })
        : '-';

    new bootstrap.Modal(document.getElementById('detailGuruModal')).show();
}

function printDetail() { window.print(); }
</script>
@endsection
