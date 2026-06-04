@extends('guru.layouts.app')

@section('title', 'Detail Mata Pelajaran - PPDB')

@section('styles')
<style>
    .mapel-header {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border-radius: 15px;
        padding: 2rem;
    }
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
    .info-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
    .info-card .card-header {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border-radius: 15px 15px 0 0;
        border: none;
    }
    .pengajar-avatar-large {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    .code-badge-large {
        background: rgba(255,255,255,0.2);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-family: 'Courier New', monospace;
        font-size: 1.1rem;
        font-weight: 600;
        border: 2px solid rgba(255,255,255,0.3);
    }
    .status-badge-large {
        padding: 8px 20px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 1rem;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-primary-gradient">Detail Mata Pelajaran</h1>
            <p class="text-muted">
                <i class="bi bi-book me-2"></i>
                Informasi lengkap mata pelajaran
            </p>
        </div>
        <div class="d-flex gap-2">
            <button onclick="history.back()" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </button>
        </div>
    </div>

    <!-- Mata Pelajaran Header -->
    <div class="mapel-header mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="mb-2">{{ $mapel->nama_mapel }}</h2>
                <div class="d-flex align-items-center gap-3">
                    <span class="code-badge-large">{{ $mapel->code_mapel }}</span>
                    <span class="text-white-50">
                        <i class="bi bi-person-badge me-1"></i>
                        {{ $mapel->nama_pengajar }}
                    </span>
                </div>
            </div>
            <div class="col-md-4 text-end">
                @if($mapel->status === 'aktif')
                    <span class="status-badge-large bg-success">Aktif</span>
                @else
                    <span class="status-badge-large bg-danger">Tidak Aktif</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Pengajar Info -->
    <div class="row mb-4">
        <div class="col-md-4 text-center">
            @if($mapel->foto_pengajar)
                <img src="{{ asset('uploads/foto-pengajar/' . $mapel->foto_pengajar) }}" 
                     alt="Foto Pengajar" class="pengajar-avatar-large mb-3">
            @else
                <div class="pengajar-avatar-large d-flex align-items-center justify-content-center bg-secondary text-white mx-auto mb-3">
                    <i class="bi bi-person fs-1"></i>
                </div>
            @endif
            <h4 class="mb-1">{{ $mapel->nama_pengajar }}</h4>
            <p class="text-muted">Pengajar Mata Pelajaran</p>
        </div>
        <div class="col-md-8">
            <div class="info-card card">
                <div class="card-header">
                    <h6 class="m-0">
                        <i class="bi bi-person-badge me-2"></i>
                        Informasi Pengajar
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Nama Lengkap</label>
                            <p class="fw-bold mb-0">{{ $mapel->nama_pengajar }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">NIP</label>
                            <p class="fw-bold mb-0">{{ $mapel->nip_pengajar }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Mata Pelajaran</label>
                            <p class="fw-bold mb-0">{{ $mapel->nama_mapel }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Kode Mapel</label>
                            <p class="fw-bold mb-0">{{ $mapel->code_mapel }}</p>
                        </div>
                        <div class="col-md-12 mb-0">
                            <label class="form-label text-muted small">Status</label>
                            <p class="mb-0">
                                @if($mapel->status === 'aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Mata Pelajaran -->
    <div class="info-card card">
        <div class="card-header">
            <h6 class="m-0">
                <i class="bi bi-book me-2"></i>
                Informasi Mata Pelajaran
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted small">Nama Mata Pelajaran</label>
                    <p class="fw-bold mb-0">{{ $mapel->nama_mapel }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted small">Kode Mata Pelajaran</label>
                    <p class="fw-bold mb-0">
                        <span class="code-badge">{{ $mapel->code_mapel }}</span>
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted small">Nama Pengajar</label>
                    <p class="fw-bold mb-0">{{ $mapel->nama_pengajar }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted small">NIP Pengajar</label>
                    <p class="fw-bold mb-0">{{ $mapel->nip_pengajar }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted small">Status</label>
                    <p class="mb-0">
                        @if($mapel->status === 'aktif')
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-danger">Tidak Aktif</span>
                        @endif
                    </p>
                </div>
                <div class="col-md-6 mb-0">
                    <label class="form-label text-muted small">Tanggal Dibuat</label>
                    <p class="fw-bold mb-0">{{ $mapel->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="d-flex justify-content-end gap-2 mt-4">
        <a href="{{ route('guru.data-mata-pelajaran.edit', $mapel->id) }}" class="btn btn-warning">
            <i class="bi bi-pencil me-2"></i>Edit
        </a>
        <form action="{{ route('guru.data-mata-pelajaran.destroy', $mapel->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data mata pelajaran ini?')">
                <i class="bi bi-trash me-2"></i>Hapus
            </button>
        </form>
    </div>
</div>
@endsection
