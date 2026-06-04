@extends('guru.layouts.app')

@section('title', 'Data Guru')

@section('styles')
<style>
    /* Status Badges */
    .status-badge {
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize; /* Membuat huruf pertama besar */
    }
    .status-aktif { background: #d4edda; color: #155724; }
    .status-tidak-aktif { background: #f8d7da; color: #721c24; }

    /* Table Styling */
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

    /* Teacher Avatar */
    .teacher-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #6c757d;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 1.2rem;
    }
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
    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-dark">Data Guru</h1>
            <p class="text-muted">Daftar semua guru yang terdaftar aktif ({{ $gurus ? count($gurus) : 0 }} data)</p>
        </div>
        <div>
            <a href="{{ route('guru.data-guru.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Guru
            </a>
        </div>
    </div>

    <!-- Tabel Data Guru -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold text-dark">Data Guru Pendidikan</h6>
            <div class="d-flex gap-2">
                <div class="input-group" style="width: 250px;">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" placeholder="Cari guru..." id="searchInput">
                </div>
                <select class="form-select form-select-sm" style="width: 150px;" id="statusFilter">
                    <option value="">Semua Status</option>
                    <option value="aktif">Aktif</option>
                    <option value="tidak-aktif">Tidak Aktif</option>
                </select>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama Lengkap</th>
                            <th>NIP</th>
                            <th>Status</th>
                            <th>Mata Pelajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gurus as $index => $guru)
                        <tr>
                            <td>{{ ($gurus->currentPage() - 1) * $gurus->perPage() + $index + 1 }}</td>
                            <td class="text-center">
                                @if(isset($guru->foto) && $guru->foto)
                                    <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto Guru" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;" onerror="this.src='https://via.placeholder.com/50x50/cccccc/000000?text={{ substr($guru->nama_lengkap, 0, 2) }}'">
                                @else
                                    <div class="teacher-avatar">
                                        {{ substr($guru->nama_lengkap, 0, 2) }}
                                    </div>
                                @endif
                            </td>
                            <td>{{ $guru->nama_lengkap }}</td>
                            <td>{{ $guru->nip }}</td>
                            <td>
                                <span class="status-badge status-{{ $guru->status }}">
                                    {{ $guru->status }}
                                </span>
                            </td>
                            <td>{{ $guru->mata_pelajaran }}</td>
                            <td>
                                <a href="{{ route('guru.data-guru.show', $guru->id) }}" class="btn btn-sm btn-primary me-1">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('guru.data-guru.edit', $guru->id) }}" class="btn btn-sm btn-warning me-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('guru.data-guru.destroy', $guru->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data guru ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-end mt-3">
                {{ $gurus->links('pagination::custom') }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Fungsi filter untuk search dan status
    function filterTable() {
        const searchValue = document.getElementById('searchInput').value.toLowerCase();
        const filterValue = document.getElementById('statusFilter').value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            let showRow = true;
            
            // Filter berdasarkan search
            if (searchValue) {
                const text = row.textContent.toLowerCase();
                showRow = text.includes(searchValue);
            }
            
            // Filter berdasarkan status
            if (showRow && filterValue) {
                const statusBadge = row.querySelector('.status-badge');
                const status = statusBadge ? statusBadge.textContent.toLowerCase().trim() : '';
                
                // Perbaikan: Pastikan perbandingan string tepat
                showRow = status === filterValue;
            }
            
            // Tampilkan atau sembunyikan baris
            row.style.display = showRow ? '' : 'none';
        });
    }

    // Event listeners
    document.getElementById('searchInput').addEventListener('keyup', filterTable);
    document.getElementById('statusFilter').addEventListener('change', filterTable);
</script>
@endsection
