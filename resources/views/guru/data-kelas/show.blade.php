@extends('guru.layouts.app')

@section('title', 'Detail Kelas - PPDB')

@section('styles')
<style>
    .kelas-header {
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
    .badge-jurusan {
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 1rem;
    }
    .badge-ipa {
        background: #e3f2fd;
        color: #1976d2;
    }
    .badge-ips {
        background: #f3e5f5;
        color: #7b1fa2;
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
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-primary-gradient">Detail Kelas</h1>
            <p class="text-muted">
                <i class="bi bi-building me-2"></i>
                Informasi lengkap kelas
            </p>
        </div>
        <div class="d-flex gap-2">
            <button onclick="history.back()" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </button>
        </div>
    </div>

    <!-- Kelas Header -->
    <div class="kelas-header mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="mb-2">{{ $kelas->nama_kelas }}</h2>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge-jurusan {{ $kelas->jurusan === 'IPA' ? 'badge-ipa' : 'badge-ips' }}">
                        {{ $kelas->jurusan }}
                    </span>
                    <span class="text-white-50">
                        <i class="bi bi-calendar3 me-1"></i>
                        {{ $kelas->semester }}
                    </span>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <h4 class="mb-1">{{ $kelas->total_siswa }}</h4>
                <p class="text-white-50 mb-0">Total Siswa</p>
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
                            <i class="bi bi-people"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">{{ $kelas->total_siswa }}</h5>
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
                            <h5 class="card-title mb-0">{{ $kelas->laki_laki }}</h5>
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
                            <h5 class="card-title mb-0">{{ $kelas->perempuan }}</h5>
                            <p class="card-text small">Perempuan</p>
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
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">{{ round(($kelas->laki_laki / $kelas->total_siswa) * 100) }}%</h5>
                            <p class="card-text small">Rasio L/P</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Kelas -->
    <div class="row">
        <div class="col-md-6">
            <div class="info-card card mb-4">
                <div class="card-header">
                    <h6 class="m-0">
                        <i class="bi bi-info-circle me-2"></i>
                        Informasi Kelas
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label text-muted small">Nama Kelas</label>
                        <p class="fw-bold mb-0">{{ $kelas['nama_kelas'] }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small">Jurusan</label>
                        <p class="fw-bold mb-0">
                            <span class="badge-jurusan {{ $kelas['jurusan'] === 'IPA' ? 'badge-ipa' : 'badge-ips' }}">
                                {{ $kelas['jurusan'] }}
                            </span>
                        </p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small">Semester</label>
                        <p class="fw-bold mb-0">{{ $kelas['semester'] }}</p>
                    </div>
                    <div class="mb-0">
                        <label class="form-label text-muted small">Total Siswa</label>
                        <p class="fw-bold mb-0">{{ $kelas['total_siswa'] }} siswa</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="info-card card mb-4">
                <div class="card-header">
                    <h6 class="m-0">
                        <i class="bi bi-person-badge me-2"></i>
                        Wali Kelas
                    </h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary mx-auto mb-2">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <h5 class="card-title mb-0">{{ $kelas['wali_kelas'] }}</h5>
                        <p class="text-muted small">Wali Kelas</p>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-envelope me-2"></i>
                            Kirim Email
                        </button>
                        <button class="btn btn-outline-success btn-sm">
                            <i class="bi bi-telephone me-2"></i>
                            Hubungi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Deskripsi Kelas -->
    <div class="info-card card mb-4">
        <div class="card-header">
            <h6 class="m-0">
                <i class="bi bi-file-text me-2"></i>
                Deskripsi Kelas
            </h6>
        </div>
        <div class="card-body">
            <p class="mb-0">{{ $kelas['deskripsi'] }}</p>
        </div>
    </div>

    <!-- Distribusi Siswa -->
    <div class="info-card card">
        <div class="card-header">
            <h6 class="m-0">
                <i class="bi bi-pie-chart me-2"></i>
                Distribusi Siswa
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>Laki-laki</span>
                            <span class="fw-bold">{{ $kelas['laki_laki'] }} siswa</span>
                        </div>
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar bg-info" role="progressbar" 
                                 style="width: {{ ($kelas['laki_laki'] / $kelas['total_siswa']) * 100 }}%"
                                 aria-valuenow="{{ $kelas['laki_laki'] }}" 
                                 aria-valuemin="0" aria-valuemax="{{ $kelas['total_siswa'] }}">
                                {{ round(($kelas['laki_laki'] / $kelas['total_siswa']) * 100) }}%
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>Perempuan</span>
                            <span class="fw-bold">{{ $kelas['perempuan'] }} siswa</span>
                        </div>
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar bg-danger" role="progressbar" 
                                 style="width: {{ ($kelas['perempuan'] / $kelas['total_siswa']) * 100 }}%"
                                 aria-valuenow="{{ $kelas['perempuan'] }}" 
                                 aria-valuemin="0" aria-valuemax="{{ $kelas['total_siswa'] }}">
                                {{ round(($kelas['perempuan'] / $kelas['total_siswa']) * 100) }}%
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
