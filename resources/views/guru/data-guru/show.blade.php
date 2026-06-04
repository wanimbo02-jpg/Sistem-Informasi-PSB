@extends('guru.layouts.app')

@section('title', 'Detail Guru - PPDB')

@section('styles')
<style>
    .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border-radius: 15px;
    }
    .teacher-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: #6c757d;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 3rem;
        margin: 0 auto 1rem;
    }
    .info-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }
    .info-value {
        color: #666;
        margin-bottom: 1rem;
    }
    .status-badge {
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
    }
    .status-aktif { background: #d4edda; color: #155724; }
    .status-tidak-aktif { background: #f8d7da; color: #721c24; }
</style>
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-dark">Detail Guru</h1>
            <p class="text-muted">Informasi lengkap data guru</p>
        </div>
        <div>
            <a href="{{ route('guru.data-guru.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
            <a href="{{ route('guru.data-guru.edit', $guru->id) }}" class="btn btn-warning">
                <i class="bi bi-pencil me-2"></i>Edit
            </a>
        </div>
    </div>

    <!-- Detail Guru -->
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    @if(isset($guru->foto) && $guru->foto)
                        <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto Guru" style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; margin: 0 auto 1rem;">
                    @else
                        <div class="teacher-avatar">
                            {{ substr($guru->nama_lengkap, 0, 2) }}
                        </div>
                    @endif
                    <h5 class="mb-1">{{ $guru->nama_lengkap }}</h5>
                    <p class="text-muted mb-2">{{ $guru->nip }}</p>
                    <span class="status-badge status-{{ $guru->status }}">
                        {{ ucfirst($guru->status) }}
                    </span>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header bg-white">
                    <h6 class="m-0 fw-bold text-dark">Informasi Pribadi</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-label">Nama Lengkap</div>
                            <div class="info-value">{{ $guru->nama_lengkap }}</div>
                            
                            <div class="info-label">NIP</div>
                            <div class="info-value">{{ $guru->nip }}</div>
                            
                            <div class="info-label">Email</div>
                            <div class="info-value">{{ $guru->email }}</div>
                            
                            <div class="info-label">Telepon</div>
                            <div class="info-value">{{ $guru->telepon }}</div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="info-label">Tanggal Lahir</div>
                            <div class="info-value">{{ date('d F Y', strtotime($guru->tanggal_lahir)) }}</div>
                            
                            <div class="info-label">Jenis Kelamin</div>
                            <div class="info-value">{{ $guru->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                            
                            <div class="info-label">Pendidikan Terakhir</div>
                            <div class="info-value">{{ $guru->pendidikan_terakhir }}</div>
                            
                            <div class="info-label">Tahun Masuk</div>
                            <div class="info-value">{{ $guru->tahun_masuk }}</div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="info-label">Alamat Lengkap</div>
                            <div class="info-value">{{ $guru->alamat }}</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card shadow mb-4">
                <div class="card-header bg-white">
                    <h6 class="m-0 fw-bold text-dark">Informasi Profesional</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-label">Status</div>
                            <div class="info-value">
                                <span class="status-badge status-{{ $guru->status }}">
                                    {{ ucfirst($guru->status) }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="info-label">Mata Pelajaran</div>
                            <div class="info-value">{{ $guru->mata_pelajaran }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
