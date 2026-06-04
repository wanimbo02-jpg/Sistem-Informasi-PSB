@extends('guru.layouts.app')

@section('title', 'Data Orang Tua - PPDB')

@section('styles')
<style>
    /* Status Badges */
    .status-badge {
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
    }
    .status-pending { background: #fff3cd; color: #856404; }
    .status-verifikasi { background: #cff4fc; color: #055160; }
    .status-diterima { background: #d4edda; color: #155724; }
    .status-ditolak { background: #f8d7da; color: #721c24; }

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

    /* Text Colors */
    .text-primary-gradient { background: linear-gradient(135deg, #667eea, #764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
</style>
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-dark">Data Orang Tua</h1>
            <p class="text-muted">Daftar data orang tua siswa yang telah mendaftar</p>
        </div>
        <div>
        </div>
    </div>

    <!-- Tabel Data Orang Tua -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold text-primary">Data Orang Tua Siswa</h6>
            <div class="d-flex gap-2">
                <div class="input-group" style="width: 250px;">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" placeholder="Cari orang tua..." id="searchInput">
                </div>
                <select class="form-select form-select-sm" style="width: 150px;" id="statusFilter">
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="verifikasi">Verifikasi</option>
                    <option value="diterima">Diterima</option>
                    <option value="ditolak">Ditolak</option>
                </select>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Nama Ayah</th>
                            <th>Nama Ibu</th>
                            <th>Pekerjaan Ayah</th>
                            <th>Pekerjaan Ibu</th>
                            <th>No. HP Orang Tua</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendaftarans as $index => $pendaftaran)
                        <tr>
                            <td>{{ ($pendaftarans->currentPage() - 1) * $pendaftarans->perPage() + $index + 1 }}</td>
                            <td>{{ $pendaftaran->nama_lengkap }}</td>
                            <td>{{ $pendaftaran->nama_ayah }}</td>
                            <td>{{ $pendaftaran->nama_ibu }}</td>
                            <td>{{ $pendaftaran->pekerjaan_ayah }}</td>
                            <td>{{ $pendaftaran->pekerjaan_ibu }}</td>
                            <td>{{ $pendaftaran->no_hp_ortu ?? '-' }}</td>
                            <td>
                                <span class="status-badge status-{{ $pendaftaran->status ?? 'pending' }}">
                                    {{ ucfirst($pendaftaran->status ?? 'pending') }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('guru.data-orang-tua.show', $pendaftaran->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                                <p class="text-muted">Belum ada data orang tua</p>
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
                const statusCell = row.querySelector('td:nth-child(9) .status-badge');
                if (statusCell) {
                    const status = statusCell.textContent.toLowerCase().trim();
                    row.style.display = status.includes(statusValue) ? '' : 'none';
                }
            }
        });
    });
</script>
@endsection
