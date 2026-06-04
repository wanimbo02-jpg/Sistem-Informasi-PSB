@extends('guru.layouts.app')

@section('title', 'Seleksi Administrasi - PPDB')

@section('styles')
<style>
    .status-badge {
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
    }
    .status-pending { background: #fff3cd; color: #856404; }
    .status-diterima { background: #d4edda; color: #155724; }
    .status-ditolak { background: #f8d7da; color: #721c24; }

    .table {
        margin-bottom: 0;
        border: 1px solid #dee2e6;
    }
    .table thead th {
        background: #f8f9fa;
        color: #333;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #dee2e6;
        padding: 1rem;
    }
    .table tbody tr {
        transition: none;
        cursor: pointer;
    }
    .table tbody tr:hover {
        background: #f8f9fa;
    }
    .table tbody td {
        border-bottom: 1px solid #dee2e6;
        padding: 0.75rem;
        vertical-align: middle;
    }

    .action-buttons {
        display: flex;
        gap: 5px;
        align-items: center;
        flex-wrap: nowrap;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        white-space: nowrap;
    }

    /* Fix dropdown positioning */
    .table-responsive {
        overflow: visible;
    }

    .dropdown-menu {
        min-width: 200px;
        z-index: 1050;
        position: absolute;
        transform: translateY(0);
    }

    .btn-group {
        position: relative;
        display: inline-flex;
        vertical-align: middle;
    }

    /* Prevent table overflow */
    .table {
        table-layout: fixed;
    }

    .table th:nth-child(8),
    .table td:nth-child(8) {
        width: 280px;
        min-width: 280px;
    }

    /* Notifikasi Popup di Tengah Halaman */
    .notification-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9998;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.3s ease-out;
    }

    .notification-popup {
        position: relative;
        z-index: 9999;
        min-width: 400px;
        max-width: 500px;
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        animation: jello 0.8s ease-out;
        backdrop-filter: blur(20px);
        overflow: hidden;
    }

    .notification-success {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border: 2px solid #28a745;
        color: #333;
    }

    .notification-error {
        background: linear-gradient(135deg, #ffffff 0%, #fff5f5 100%);
        border: 2px solid #dc3545;
        color: #333;
    }

    .notification-popup .notification-header {
        padding: 30px 30px 20px 30px;
        text-align: center;
        border-bottom: 1px solid #e9ecef;
    }

    .notification-popup .notification-body {
        padding: 20px 30px 30px 30px;
        text-align: center;
    }

    .notification-popup .notification-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        margin: 0 auto 20px auto;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
        animation: pulse 2s infinite;
    }

    .notification-error .notification-icon {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        box-shadow: 0 8px 25px rgba(220, 53, 69, 0.3);
    }

    .notification-popup .notification-title {
        font-size: 24px;
        font-weight: 700;
        margin: 0 0 10px 0;
        color: #28a745;
    }

    .notification-error .notification-title {
        color: #dc3545;
    }

    .notification-popup .notification-message {
        font-size: 16px;
        margin: 0;
        color: #666;
        line-height: 1.5;
    }

    .notification-popup .notification-close {
        position: absolute;
        top: 20px;
        right: 20px;
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        color: #666;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 18px;
    }

    .notification-popup .notification-close:hover {
        background: #e9ecef;
        transform: scale(1.1);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes zoomIn {
        0% {
            transform: scale(0.1);
            opacity: 0;
        }
        25% {
            transform: scale(0.5);
            opacity: 0.5;
        }
        50% {
            transform: scale(0.9);
            opacity: 0.8;
        }
        75% {
            transform: scale(1.1);
            opacity: 0.9;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes jello {
        0% {
            transform: scale3d(1, 1, 1);
        }
        30% {
            transform: scale3d(1.25, 0.75, 1);
        }
        40% {
            transform: scale3d(0.75, 1.25, 1);
        }
        50% {
            transform: scale3d(1.15, 0.85, 1);
        }
        65% {
            transform: scale3d(0.95, 1.05, 1);
        }
        75% {
            transform: scale3d(1.05, 0.95, 1);
        }
        100% {
            transform: scale3d(1, 1, 1);
        }
    }

    @keyframes zoomOut {
        from {
            transform: scale(1);
            opacity: 1;
        }
        to {
            transform: scale(0.8);
            opacity: 0;
        }
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
        }
    }

    .notification-overlay.hiding {
        animation: fadeOut 0.3s ease-out forwards;
    }

    .notification-overlay.hiding .notification-popup {
        animation: zoomOut 0.3s ease-out forwards;
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
        }
    }
</style>
@endsection

@section('content')
<!-- Container untuk Notifikasi Popup -->
<div id="notificationContainer"></div>

<div class="container-fluid">       
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-dark">Seleksi Administrasi</h1>
            <p class="text-muted">Siswa yang diterima dalam seleksi administrasi</p>
        </div>
        <div>
            <div class="input-group" style="width: 250px;">
                <span class="input-group-text bg-white border-end-0">
                    <i class="bi bi-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0" placeholder="Cari siswa..." id="searchInput">
            </div>
        </div>
    </div>

    <!-- Tabel Data Siswa -->
    <div class="card shadow mb-4">
        <div class="card-header bg-white border-bottom">
            <h6 class="m-0 fw-bold text-primary">Data Siswa Diterima Seleksi Administrasi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <!-- <th>NIK</th> -->
                            <th>NISN</th>
                            <th>Jenis Kelamin</th>
                            <th>Asal Sekolah</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendaftarans as $index => $pendaftaran)
                        <tr>
                            <td>{{ ($pendaftarans->currentPage() - 1) * $pendaftarans->perPage() + $index + 1 }}</td>
                            <td>{{ $pendaftaran->nama_lengkap }}</td>
                            <!-- <td>{{ $pendaftaran->nik }}</td> -->
                            <td>{{ $pendaftaran->nisn }}</td>
                            <td>{{ $pendaftaran->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td>{{ $pendaftaran->asal_sekolah }}</td>
                            <td>{{ $pendaftaran->tanggal_pendaftaran ? \Carbon\Carbon::parse($pendaftaran->tanggal_pendaftaran)->format('d/m/Y') : \Carbon\Carbon::parse($pendaftaran->created_at)->format('d/m/Y') }}</td>
                            <td>
                                <span class="status-badge status-diterima">
                                    Diterima Administrasi
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('guru.data-siswa.show', $pendaftaran->id) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="dropdownMenuButton{{ $pendaftaran->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-gear"></i> Aksi
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $pendaftaran->id }}">
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="submitForm('diterima', {{ $pendaftaran->id }})">
                                                    <i class="bi bi-check-circle-fill text-success me-2"></i>Anda Dinyatakan Lulus
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="submitForm('tidak_diterima', {{ $pendaftaran->id }})">
                                                    <i class="bi bi-x-circle-fill text-danger me-2"></i>Anda Dinyatakan Tidak Lulus
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#kelasModal{{ $pendaftaran->id }}">
                                                    <i class="bi bi-building text-primary me-2"></i>Pilih Kelas
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $pendaftaran->id }}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>

                                    <!-- Hidden forms for status updates -->
                                    <form id="form-diterima-{{ $pendaftaran->id }}" action="{{ route('guru.siswa-diseleksi.update', $pendaftaran->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status_seleksi" value="diterima">
                                    </form>
                                    <form id="form-tidak_diterima-{{ $pendaftaran->id }}" action="{{ route('guru.siswa-diseleksi.update', $pendaftaran->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status_seleksi" value="tidak_diterima">
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                                <p class="text-muted">Belum ada siswa yang diterima dalam seleksi administrasi</p>
                                <p class="text-muted small">Edit data siswa dan ubah status menjadi "Anda_diterima_seleksi_administrasi" untuk menambahkan siswa ke sini.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-end mt-3">
                {{ $pendaftarans->links('pagination::custom') }}
            </div>
        </div>
    </div>
</div>

<!-- Modal Pemilihan Kelas -->
@foreach($pendaftarans as $pendaftaran)
<div class="modal fade" id="kelasModal{{ $pendaftaran->id }}" tabindex="-1" aria-labelledby="kelasModalLabel{{ $pendaftaran->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="kelasModalLabel{{ $pendaftaran->id }}">
                    <i class="bi bi-building me-2"></i>Pilih Kelas untuk {{ $pendaftaran->nama_lengkap }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('guru.siswa-diseleksi.update', $pendaftaran->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="status_seleksi" value="diterima">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kelas{{ $pendaftaran->id }}" class="form-label fw-bold">
                            <i class="bi bi-grid-3x3-gap me-1"></i>Pilih Kelas
                        </label>
                        <select class="form-select form-select-lg" id="kelas{{ $pendaftaran->id }}" name="kelas" required>
                            <option value="">-- Pilih Kelas --</option>
                            <optgroup label="IPA">
                                <option value="X IPA 1" {{ old('kelas', $pendaftaran->kelas) == 'X IPA 1' ? 'selected' : '' }}>X IPA 1</option>
                                <option value="XI IPA 2" {{ old('kelas', $pendaftaran->kelas) == 'XI IPA 2' ? 'selected' : '' }}>XI IPA 2</option>
                                <option value="XII IPA 3" {{ old('kelas', $pendaftaran->kelas) == 'XII IPA 3' ? 'selected' : '' }}>XII IPA 3</option>
                            </optgroup>
                            <optgroup label="IPS">
                                <option value="X IPS 1" {{ old('kelas', $pendaftaran->kelas) == 'X IPS 1' ? 'selected' : '' }}>X IPS 1</option>
                                <option value="XI IPS 2" {{ old('kelas', $pendaftaran->kelas) == 'XI IPS 2' ? 'selected' : '' }}>XI IPS 2</option>
                                <option value="XII IPS 3" {{ old('kelas', $pendaftaran->kelas) == 'XII IPS 3' ? 'selected' : '' }}>XII IPS 3</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="alert alert-info d-flex align-items-center">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        <div>
                            <strong>Informasi:</strong> Pilih kelas yang sesuai untuk siswa ini. Data akan tersimpan otomatis.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-1"></i>Simpan & Nyatakan Lulus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Hapus -->
@foreach($pendaftarans as $pendaftaran)
<div class="modal fade" id="deleteModal{{ $pendaftaran->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $pendaftaran->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel{{ $pendaftaran->id }}">
                    <i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('guru.siswa-diseleksi.destroy', $pendaftaran->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="alert alert-warning d-flex align-items-center">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <div>
                            <strong>Peringatan!</strong> Tindakan ini akan menghapus data siswa secara permanen.
                        </div>
                    </div>
                    <p>Apakah Anda yakin ingin menghapus data siswa <strong>{{ $pendaftaran->nama_lengkap }}</strong>?</p>
                    <p class="text-danger"><small>NISN: {{ $pendaftaran->nisn }}</small></p>
                    <p class="text-muted"><small>Tindakan ini tidak dapat dibatalkan!</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>Hapus Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection

@section('scripts')
<script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });

    // Function to submit hidden forms
    function submitForm(status, id) {
        const formId = 'form-' + status + '-' + id;
        const form = document.getElementById(formId);
        if (form) {
            form.submit();
        }
    }

    // Fungsi untuk menampilkan notifikasi popup di tengah
    function showNotification(title, message, type = 'success') {
        const container = document.getElementById('notificationContainer');
        const notificationId = 'notification-' + Date.now();
        
        const notificationHTML = `
            <div id="${notificationId}" class="notification-overlay">
                <div class="notification-popup notification-${type}">
                    <div class="notification-header">
                        <div class="notification-icon">
                            <i class="bi ${type === 'success' ? 'bi-check-circle-fill' : 'bi-x-circle-fill'}"></i>
                        </div>
                        <div>
                            <h5 class="notification-title">${title}</h5>
                            <p class="notification-message">${message}</p>
                        </div>
                    </div>
                    <button class="notification-close" onclick="hideNotification('${notificationId}')">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
            </div>
        `;
        
        container.insertAdjacentHTML('beforeend', notificationHTML);
        
        // Auto hide setelah 5 detik
        setTimeout(() => {
            hideNotification(notificationId);
        }, 5000);
    }

    // Fungsi untuk menyembunyikan notifikasi
    function hideNotification(notificationId) {
        const notification = document.getElementById(notificationId);
        if (notification) {
            notification.classList.add('hiding');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }
    }

    // Cek session flash untuk menampilkan notifikasi
    function checkNotificationStatus() {
        // Cek session flash untuk hapus
        @if(session('success_hapus'))
            showNotification('Data Berhasil Dihapus!', '{{ session('success_hapus') }}', 'success');
        @endif
        
        // Cek session flash dari Laravel
        @if(session('status') && session('message'))
            const status = '{{ session('status') }}';
            const message = '{{ session('message') }}';
            
            let title = '';
            let type = 'success';
            
            if (status === 'success_lulus') {
                title = 'Siswa Dinyatakan Lulus!';
                type = 'success';
                showNotification(title, message, type);
            } else if (status === 'success_tidak_lulus') {
                title = 'Siswa Dinyatakan Tidak Lulus!';
                type = 'error';
                showNotification(title, message, type);
            } else if (status === 'success_kelas') {
                title = 'Kelas Berhasil Dipilih!';
                type = 'success';
                showNotification(title, message, type);
            } else if (status === 'success') {
                title = 'Data Berhasil Dihapus!';
                type = 'success';
                showNotification(title, message, type);
            } else if (status === 'error') {
                title = 'Gagal!';
                type = 'error';
                showNotification(title, message, type);
            }
        @endif
    }

    // Jalankan saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        checkNotificationStatus();
    });

    // Notifikasi akan ditampilkan melalui session flash dari controller
</script>
@endsection
