@extends('guru.layouts.app')

@section('title', 'Data Kelas - PPDB')

@section('styles')
<style>
    .stat-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: transform 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    .table {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
    .table thead {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
    }
    .badge-jurusan {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
    }
    .badge-ipa {
        background: #e3f2fd;
        color: #1976d2;
    }
    .badge-ips {
        background: #f3e5f5;
        color: #7b1fa2;
    }
    .btn-action {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.85rem;
    }
    .kelas-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: transform 0.3s ease;
    }
    .kelas-card:hover {
        transform: translateY(-3px);
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-dark">Data Kelas</h1>
            <p class="text-muted">Informasi lengkap kelas SMAN Karubaga</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('guru.data-kelas.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Kelas
            </a>
            <div class="input-group" style="width: 250px;">
                <span class="input-group-text bg-white border-end-0">
                    <i class="bi bi-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0" placeholder="Cari kelas..." id="searchInput">
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-white bg-opacity-25 me-3">
                            <i class="bi bi-building"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">{{ $totalKelas }}</h5>
                            <p class="card-text small">Total Kelas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-white bg-opacity-25 me-3">
                            <i class="bi bi-people"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">{{ $totalSiswa }}</h5>
                            <p class="card-text small">Total Siswa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-white bg-opacity-25 me-3">
                            <i class="bi bi-gender-male"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">{{ $totalLakiLaki }}</h5>
                            <p class="card-text small">Laki-laki</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card card bg-danger text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-white bg-opacity-25 me-3">
                            <i class="bi bi-gender-female"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">{{ $totalPerempuan }}</h5>
                            <p class="card-text small">Perempuan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jurusan Statistics -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="kelas-card card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="card-title mb-1">Kelas IPA</h6>
                            <p class="text-muted small mb-0">Jurusan Ilmu Pengetahuan Alam</p>
                        </div>
                        <div class="text-end">
                            <h4 class="mb-0 text-primary">{{ $totalKelasIPA }}</h4>
                            <small class="text-muted">Kelas</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="kelas-card card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="card-title mb-1">Kelas IPS</h6>
                            <p class="text-muted small mb-0">Jurusan Ilmu Pengetahuan Sosial</p>
                        </div>
                        <div class="text-end">
                            <h4 class="mb-0 text-purple">{{ $totalKelasIPS }}</h4>
                            <small class="text-muted">Kelas</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Kelas -->
    <div class="card shadow mb-4">
        <div class="card-header bg-white border-bottom">
            <h6 class="m-0 fw-bold text-primary">Daftar Kelas SMAN Karubaga</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Jurusan</th>
                            <th>Wali Kelas</th>
                            <th>Semester</th>
                            <th>Total Siswa</th>
                            <th>Laki-laki</th>
                            <th>Perempuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataKelas as $index => $kelas)
                        <tr>
                            <td>{{ ($dataKelas->currentPage() - 1) * $dataKelas->perPage() + $index + 1 }}</td>
                            <td>
                                <strong>{{ $kelas->nama_kelas }}</strong>
                            </td>
                            <td>
                                <span class="badge-jurusan {{ $kelas->jurusan === 'IPA' ? 'badge-ipa' : 'badge-ips' }}">
                                    {{ $kelas->jurusan }}
                                </span>
                            </td>
                            <td>{{ $kelas->wali_kelas }}</td>
                            <td>{{ $kelas->semester }}</td>
                            <td>
                                <span class="badge bg-success">{{ $kelas->total_siswa }}</span>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $kelas->laki_laki }}</span>
                            </td>
                            <td>
                                <span class="badge bg-danger">{{ $kelas->perempuan }}</span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('guru.data-kelas.show', $kelas->id) }}" class="btn btn-sm btn-primary btn-action">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('guru.data-kelas.edit', $kelas->id) }}" class="btn btn-sm btn-warning btn-action">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('guru.data-kelas.destroy', $kelas->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-action" onclick="return confirm('Apakah Anda yakin ingin menghapus data kelas ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                                <p class="text-muted">Belum ada data kelas</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-end mt-2">
                {{ $dataKelas->links('pagination::custom') }}
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
