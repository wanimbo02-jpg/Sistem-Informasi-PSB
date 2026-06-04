@extends('admin.layouts.app')

@section('title', 'Seleksi Administrasi - Admin')

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
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
</style>
@endsection

@section('content')
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
                                    <a href="{{ route('admin.seleksi-administrasi.show', $pendaftaran->id) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                    <div class="btn-group dropstart" role="group" style="display: inline;">
                                        <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-gear"></i> Aksi
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <form action="{{ route('admin.seleksi-administrasi.update', $pendaftaran->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status_seleksi" value="diterima">
                                                    <button type="submit" class="dropdown-item" style="color: #198754;">
                                                        <i class="bi bi-check-circle-fill me-2"></i>Anda Dinyatakan Lulus
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.seleksi-administrasi.update', $pendaftaran->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status_seleksi" value="tidak_diterima">
                                                    <button type="submit" class="dropdown-item" style="color: #dc3545;">
                                                        <i class="bi bi-x-circle-fill me-2"></i>Anda Dinyatakan Tidak Lulus
                                                    </button>
                                                </form>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <button type="button" class="dropdown-item" style="color: #0d6efd;" data-bs-toggle="modal" data-bs-target="#kelasModal{{ $pendaftaran->id }}">
                                                    <i class="bi bi-building me-2"></i>Pilih Kelas
                                                </button>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $pendaftaran->id }}">
                                                    <i class="bi bi-trash me-2"></i>Hapus
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
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
            <form action="{{ route('admin.seleksi-administrasi.update', $pendaftaran->id) }}" method="POST">
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
            <form action="{{ route('admin.seleksi-administrasi.destroy', $pendaftaran->id) }}" method="POST">
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
</script>
@endsection
