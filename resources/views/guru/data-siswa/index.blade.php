@extends('guru.layouts.app')

@section('title', 'Data Siswa - PPDB')

@section('styles')
<style>
    /* Status Badges */
    .status-badge {
        padding: 6px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        white-space: normal;
        line-height: 1.3;
        display: inline-block;
        word-wrap: break-word;
        max-width: 180px;
    }
    .status-pending { background: #fff3cd; color: #856404; }
    .status-verifikasi { background: #cff4fc; color: #055160; }
    .status-diterima { background: #d4edda; color: #155724; }
    .status-ditolak { background: #f8d7da; color: #721c24; }
    .status-lulus-seleksi-administrasi { background: #d1ecf1; color: #0c5460; }
    .status-tidak-lulus-seleksi-administrasi { background: #f5c6cb; color: #721c24; }

    /* Student Avatar */
    .student-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 1.2rem;
    }

    /* Table Styling */
    .table {
        margin-bottom: 0;
        border: 1px solid #dee2e6;
        table-layout: fixed;
        width: 100%;
    }
    .table thead th {
        background: #f8f9fa;
        color: #333;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #dee2e6;
        padding: 0.75rem;
        text-align: center;
        vertical-align: middle;
    }
    .table tbody td {
        padding: 0.75rem;
        vertical-align: middle;
        text-align: center;
    }
    .table tbody td:nth-child(2),
    .table tbody td:nth-child(5),
    .table tbody td:nth-child(6) {
        text-align: left;
    }
    .table tbody td:nth-child(8) {
        vertical-align: middle;
        padding: 8px;
        white-space: nowrap;
    }
    .table tbody td:nth-child(9) {
        vertical-align: middle;
        padding: 8px;
        white-space: nowrap;
        text-align: center;
    }
    .table tbody td:nth-child(9) .btn {
        margin: 0 2px;
        padding: 6px 8px;
        font-size: 12px;
    }
    .table th:nth-child(1) { width: 50px; }
    .table th:nth-child(2) { width: 200px; }
    .table th:nth-child(3) { width: 80px; }
    .table th:nth-child(4) { width: 120px; }
    .table th:nth-child(5) { width: 120px; }
    .table th:nth-child(6) { width: 150px; }
    .table th:nth-child(7) { width: 120px; }
    .table th:nth-child(8) { width: 200px; }
    .table th:nth-child(9) { width: 120px; }
    .table tbody tr {
        transition: none;
        cursor: pointer;
    }
    .table tbody tr:hover {
        background: #f8f9fa;
        transform: none;
        box-shadow: none;
    }
    .table tbody td {
        border-bottom: 1px solid #dee2e6;
    }

    /* Card Header */
    .card-header {
        background: white;
        border-bottom: 1px solid #e9ecef;
        padding: 1rem 1.5rem;
    }

    /* Text Colors */
    .text-primary-gradient { background: linear-gradient(135deg, #667eea, #764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
</style>
<style>
/* Perbaikan tampilan tabel */
.table {
    margin-bottom: 0;
    white-space: nowrap;
}

.table thead th {
    background-color: #f8f9fa;
    font-weight: 600;
    font-size: 0.85rem;
    padding: 0.75rem;
    border-bottom: 2px solid #dee2e6;
}

.table tbody td {
    padding: 0.75rem;
    vertical-align: middle;
    font-size: 0.9rem;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}

/* Badge status */
.badge {
    font-weight: 500;
    border-radius: 50px;
}

/* Text truncate untuk konten panjang */
.text-truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Responsif */
@media (max-width: 768px) {
    .table {
        font-size: 0.8rem;
    }
    
    .table td, .table th {
        padding: 0.5rem;
    }
}
</style>
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-dark">Data Siswa</h1>
            <p class="text-muted">siswa baru yang telah mendaftar</p>
        </div>
        <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exportModal">
                <i class="bi bi-download me-2"></i>Export Data
            </button>
        </div>
    </div>

    <!-- Tabel Data Siswa -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold text-primary">Data Siswa yang baru daftar</h6>
            <div class="d-flex gap-2">
                <div class="input-group" style="width: 250px;">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" placeholder="Cari siswa..." id="searchInput">
                </div>
                <select class="form-select form-select-sm" style="width: 150px;" id="statusFilter">
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="verifikasi">Verifikasi</option>
                    <!-- <option value="diterima">Diterima</option>
                    <option value="ditolak">Ditolak</option> -->
                    <option value="lulus-seleksi-administrasi">Lulus seleksi administrasi</option>
                    <option value="tidak-lulus-seleksi-administrasi">Tidak lulus seleksi administrasi</option>
                </select>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Foto</th>
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
                            <td>
                                @if($pendaftaran->foto)
                                    <img src="{{ asset('uploads/foto/' . $pendaftaran->foto) }}" alt="Foto Siswa" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                                @else
                                    <div style="width: 50px; height: 50px; border-radius: 50%; background: #6c757d; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                        {{ substr($pendaftaran->nama_lengkap, 0, 1) }}
                                    </div>
                                @endif
                            </td>
                            <td>{{ $pendaftaran->nisn ?? '-' }}</td>
                            <td>
                                @if($pendaftaran->jenis_kelamin == 'L')
                                    <span class="badge bg-primary">Laki-laki</span>
                                @elseif($pendaftaran->jenis_kelamin == 'P')
                                    <span class="badge bg-danger">Perempuan</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $pendaftaran->asal_sekolah }}</td>
                            <td>{{ $pendaftaran->tanggal_pendaftaran ? \Carbon\Carbon::parse($pendaftaran->tanggal_pendaftaran)->format('d/m/Y') : \Carbon\Carbon::parse($pendaftaran->created_at)->format('d/m/Y') }}</td>
                            <td>
                                <span class="status-badge status-{{ $pendaftaran->status ?? 'pending' }}">
                                    {{ ucfirst($pendaftaran->status ?? 'pending') }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('guru.data-siswa.show', $pendaftaran->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('guru.data-siswa.edit', $pendaftaran->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('guru.data-siswa.destroy', $pendaftaran->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center py-4">
                                <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                                <p class="text-muted">Belum ada data siswa</p>
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

    // Status filter
    document.getElementById('statusFilter').addEventListener('change', function() {
        const statusValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            if (statusValue === '') {
                row.style.display = '';
            } else {
                const statusCell = row.querySelector('td:nth-child(8) .status-badge');
                if (statusCell) {
                    const statusText = statusCell.textContent.toLowerCase().trim();
                    let shouldShow = false;
                    
                    // Mapping untuk status yang sesuai
                    switch(statusValue) {
                        case 'pending':
                            shouldShow = statusText.includes('pending');
                            break;
                        case 'verifikasi':
                            shouldShow = statusText.includes('verifikasi');
                            break;
                        case 'lulus-seleksi-administrasi':
                            shouldShow = statusText.includes('lulus seleksi administrasi');
                            break;
                        case 'tidak-lulus-seleksi-administrasi':
                            shouldShow = statusText.includes('tidak lulus seleksi administrasi');
                            break;
                        default:
                            shouldShow = statusText.includes(statusValue);
                    }
                    
                    row.style.display = shouldShow ? '' : 'none';
                }
            }
        });
    });
</script>

<!-- Modal Export Data -->
<div class="modal fade" id="exportModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Export Data Pendaftar</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Pilih format export:</p>
                <div class="d-grid gap-2">
                    <a href="{{ url('/guru/data-siswa/export/excel') }}" class="btn btn-outline-success">
                        <i class="bi bi-file-excel me-2"></i>Export ke Excel
                    </a>
                    <a href="{{ url('/guru/data-siswa/export/pdf') }}" class="btn btn-outline-danger">
                        <i class="bi bi-file-pdf me-2"></i>Export ke PDF
                    </a>
                    <a href="{{ url('/guru/data-siswa/export/print') }}" class="btn btn-outline-primary" target="_blank">
                        <i class="bi bi-printer me-2"></i>Cetak
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
