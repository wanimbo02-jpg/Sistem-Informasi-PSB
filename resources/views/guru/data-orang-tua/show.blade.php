@extends('guru.layouts.app')

@section('title', 'Detail Orang Tua - PPDB')

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

    /* Card Styling */
    .card {
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        border-radius: 15px;
    }
    .card-header {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border-radius: 15px 15px 0 0 !important;
        border: none;
    }

    /* Section Title */
    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #667eea;
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
    }
    .info-item {
        padding: 0.75rem;
        background: #f8f9fa;
        border-radius: 8px;
        border-left: 3px solid #667eea;
    }
    .info-label {
        font-size: 0.85rem;
        color: #6c757d;
        margin-bottom: 0.25rem;
    }
    .info-value {
        font-weight: 600;
        color: #2d3748;
    }

    /* Text Colors */
    .text-primary-gradient { background: linear-gradient(135deg, #667eea, #764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    
    /* Tab Navigation Styles */
    .tab-navigation {
        background: white;
        border-radius: 15px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
    .tab-buttons {
        display: flex;
        gap: 10px;
        justify-content: center;
        flex-wrap: wrap;
    }
    .tab-btn {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: none;
        background: #f8f9fa;
        color: #6c757d;
        font-weight: bold;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .tab-btn:hover {
        background: #e9ecef;
        transform: translateY(-2px);
    }
    .tab-btn.active {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }
    .tab-content {
        display: none;
        animation: fadeIn 0.5s ease;
    }
    .tab-content.active {
        display: block;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection

@section('content')
<div class="container-fluid px-4">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-primary-gradient">Detail Orang Tua</h1>
            <p class="text-muted">
                <i class="bi bi-person-heart me-2"></i>
                Informasi lengkap orang tua siswa
            </p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('guru.data-orang-tua.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- Student Info Card (Always Visible) -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <h5 class="mb-1">{{ $pendaftaran->nama_lengkap }}</h5>
                            <p class="text-muted mb-2">Siswa Pendaftar</p>
                            <span class="status-badge status-{{ $pendaftaran->status ?? 'pending' }}">
                                {{ ucfirst($pendaftaran->status ?? 'pending') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="tab-navigation">
        <div class="tab-buttons">
            <button class="tab-btn active" data-tab="tab1">1</button>
            <button class="tab-btn" data-tab="tab2">2</button>
            <!-- <button class="tab-btn" data-tab="tab3">3</button> -->
            <button class="tab-btn" data-tab="tab4">3</button>
            <button class="tab-btn" data-tab="tab5">4</button>
        </div>
    </div>

    <!-- Tab 1: Data Ayah -->
    <div id="tab1" class="tab-content active">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="bi bi-person-badge me-2"></i>Data Ayah</h6>
                    </div>
                    <div class="card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Nama Ayah</div>
                                <div class="info-value">{{ $pendaftaran->nama_ayah }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">NIK</div>
                                <div class="info-value">{{ $pendaftaran->nik_ayah }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Pekerjaan</div>
                                <div class="info-value">{{ $pendaftaran->pekerjaan_ayah }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Pendidikan Terakhir</div>
                                <div class="info-value">{{ $pendaftaran->pendidikan_ayah }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Penghasilan</div>
                                <div class="info-value">{{ $pendaftaran->penghasilan_ayah }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">No. Telepon</div>
                                <div class="info-value">{{ $pendaftaran->no_hp_ortu ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab 2: Data Ibu -->
    <div id="tab2" class="tab-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="bi bi-person-heart me-2"></i>Data Ibu</h6>
                    </div>
                    <div class="card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Nama Ibu</div>
                                <div class="info-value">{{ $pendaftaran->nama_ibu }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">NIK</div>
                                <div class="info-value">{{ $pendaftaran->nik_ibu }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Pekerjaan</div>
                                <div class="info-value">{{ $pendaftaran->pekerjaan_ibu }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Pendidikan Terakhir</div>
                                <div class="info-value">{{ $pendaftaran->pendidikan_ibu }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Penghasilan</div>
                                <div class="info-value">{{ $pendaftaran->penghasilan_ibu }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">No. Telepon</div>
                                <div class="info-value">{{ $pendaftaran->no_hp_ortu ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <!-- Tab 4: Ringkasan Kontak -->
    <div id="tab4" class="tab-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="bi bi-telephone me-2"></i>Ringkasan Kontak</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="text-center">
                                    <div class="mb-2">
                                        <i class="bi bi-person-badge text-primary fs-1"></i>
                                    </div>
                                    <h6>Ayah</h6>
                                    <p class="mb-0"><strong>{{ $pendaftaran->nama_ayah }}</strong></p>
                                    <small class="text-muted">{{ $pendaftaran->no_hp_ortu ?? '-' }}</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="text-center">
                                    <div class="mb-2">
                                        <i class="bi bi-person-heart text-success fs-1"></i>
                                    </div>
                                    <h6>Ibu</h6>
                                    <p class="mb-0"><strong>{{ $pendaftaran->nama_ibu }}</strong></p>
                                    <small class="text-muted">{{ $pendaftaran->no_hp_ortu ?? '-' }}</small>
                                </div>
                            </div>
                            @if($pendaftaran->nama_wali)
                            <div class="col-md-4 mb-3">
                                <div class="text-center">
                                    <div class="mb-2">
                                        <i class="bi bi-person-check text-warning fs-1"></i>
                                    </div>
                                    <h6>Wali</h6>
                                    <p class="mb-0"><strong>{{ $pendaftaran->nama_wali }}</strong></p>
                                    <small class="text-muted">{{ $pendaftaran->no_hp_ortu ?? '-' }}</small>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab 5: Informasi Siswa -->
    <div id="tab5" class="tab-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="bi bi-person me-2"></i>Informasi Siswa</h6>
                    </div>
                    <div class="card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Nama Lengkap</div>
                                <div class="info-value">{{ $pendaftaran->nama_lengkap }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">NISN</div>
                                <div class="info-value">{{ $pendaftaran->nisn }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Jenis Kelamin</div>
                                <div class="info-value">{{ $pendaftaran->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Asal Sekolah</div>
                                <div class="info-value">{{ $pendaftaran->asal_sekolah }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Tahun Lulus</div>
                                <div class="info-value">{{ $pendaftaran->tahun_lulus }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">No. HP Siswa</div>
                                <div class="info-value">{{ $pendaftaran->handphone }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Email</div>
                                <div class="info-value">{{ $pendaftaran->email }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Status Pendaftaran</div>
                                <div class="info-value">
                                    <span class="status-badge status-{{ $pendaftaran->status ?? 'pending' }}">
                                        {{ ucfirst($pendaftaran->status ?? 'pending') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    // Tab functionality
    document.addEventListener('DOMContentLoaded', function() {
        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');
        
        tabBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');
                
                // Remove active class from all buttons and contents
                tabBtns.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));
                
                // Add active class to clicked button and corresponding content
                this.classList.add('active');
                document.getElementById(tabId).classList.add('active');
            });
        });
    });
</script>
@endsection

@endsection