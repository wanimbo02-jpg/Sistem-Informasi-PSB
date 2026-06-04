@extends('guru.layouts.app')

@section('title', 'Data Mata Pelajaran - PPDB')

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
    .pengajar-avatar {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #dee2e6;
    }
    .btn-action {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.85rem;
    }
    .code-badge {
        background: #f8f9fa;
        color: #495057;
        padding: 4px 8px;
        border-radius: 6px;
        font-family: 'Courier New', monospace;
        font-size: 0.85rem;
        border: 1px solid #dee2e6;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-dark">Data Mata Pelajaran</h1>
            <p class="text-muted">Informasi lengkap mata pelajaran dan pengajar SMAN Karubaga</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('guru.data-mata-pelajaran.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Mata Pelajaran
            </a>
            <div class="input-group" style="width: 250px;">
                <span class="input-group-text bg-white border-end-0">
                    <i class="bi bi-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0" placeholder="Cari mata pelajaran..." id="searchInput">
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="stat-card card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-white bg-opacity-25 me-3">
                            <i class="bi bi-book"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">{{ $totalMapel }}</h5>
                            <p class="card-text small">Total Mata Pelajaran</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="stat-card card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-white bg-opacity-25 me-3">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">{{ $mapelAktif }}</h5>
                            <p class="card-text small">Mapel Aktif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="stat-card card bg-danger text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-white bg-opacity-25 me-3">
                            <i class="bi bi-x-circle"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">{{ $mapelTidakAktif }}</h5>
                            <p class="card-text small">Mapel Tidak Aktif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Mata Pelajaran -->
    <div class="card shadow mb-4">
        <div class="card-header bg-white border-bottom">
            <h6 class="m-0 fw-bold text-primary">Daftar Mata Pelajaran SMAN Karubaga</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Mata Pelajaran</th>
                            <th>Kode Mapel</th>
                            <th>Nama PM</th>
                            <th>Foto Pengajar</th>
                            <th>NIP</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataMapel as $index => $mapel)
                        <tr>
                            <td>{{ ($dataMapel->currentPage() - 1) * $dataMapel->perPage() + $index + 1 }}</td>
                            <td>
                                <strong>{{ $mapel->nama_mapel }}</strong>
                            </td>
                            <td>
                                <span class="code-badge">{{ $mapel->code_mapel }}</span>
                            </td>
                            <td>{{ $mapel->nama_pengajar }}</td>
                            <td class="text-center">
                                @if($mapel->foto_pengajar)
                                    <img src="{{ asset('uploads/foto-pengajar/' . $mapel->foto_pengajar) }}" 
                                         alt="Foto Pengajar" class="pengajar-avatar">
                                @else
                                    <div class="pengajar-avatar d-flex align-items-center justify-content-center bg-secondary text-white">
                                        <i class="bi bi-person"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $mapel->nip_pengajar }}</td>
                            <td>
                                @if($mapel->status === 'aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('guru.data-mata-pelajaran.show', $mapel->id) }}" class="btn btn-sm btn-primary btn-action">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('guru.data-mata-pelajaran.edit', $mapel->id) }}" class="btn btn-sm btn-warning btn-action">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('guru.data-mata-pelajaran.destroy', $mapel->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-action" onclick="return confirm('Apakah Anda yakin ingin menghapus data mata pelajaran ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                                <p class="text-muted">Belum ada data mata pelajaran</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="d-flex justify-content-end mt-2">
                {{ $dataMapel->links('pagination::custom') }}
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
