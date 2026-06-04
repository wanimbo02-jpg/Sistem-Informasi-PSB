@extends('guru.layouts.app')

@section('title', 'Detail Siswa - PPDB')

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

    /* Student Avatar */
    .student-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 3rem;
        margin: 0 auto 20px;
    }

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
    
    /* Document Actions */
    .document-actions {
        margin-top: 10px;
    }
    .btn-sm-custom {
        padding: 5px 10px;
        font-size: 12px;
        margin: 0 3px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid px-4">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-primary-gradient">Detail Siswa</h1>
            <p class="text-muted">
                <i class="bi bi-person-circle me-2"></i>
                Informasi lengkap siswa pendaftar
            </p>
        </div>
        <div class="d-flex gap-2">
            <button onclick="history.back()" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </button>
        </div>
    </div>

    <!-- Student Profile Card (Always Visible) -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center">
                    <div class="student-avatar">
                        @if($pendaftaran->foto)
                            <img src="{{ asset('uploads/foto/' . $pendaftaran->foto) }}" alt="foto" style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover;">
                        @elseif($pendaftaran->berkas && $pendaftaran->berkas->file_foto)
                            <img src="{{ asset('storage/' . $pendaftaran->berkas->file_foto) }}" alt="foto" style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover;">
                        @else
                            <div style="width: 120px; height: 120px; border-radius: 50%; background: #e9ecef; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                <i class="bi bi-person text-muted" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                    </div>
                    <h5 class="mb-1 mt-3">{{ $pendaftaran->nama_lengkap }}</h5>
                    <p class="text-muted mb-2">Siswa Pendaftar</p>
                    <span class="status-badge status-{{ $pendaftaran->status ?? 'pending' }}">
                        {{ ucfirst($pendaftaran->status ?? 'pending') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="tab-navigation">
        <div class="tab-buttons">
            <button class="tab-btn active" data-tab="tab1">1</button>
            <button class="tab-btn" data-tab="tab2">2</button>
            <button class="tab-btn" data-tab="tab3">3</button>
            <button class="tab-btn" data-tab="tab4">4</button>
        </div>
    </div>

    <!-- Tab 1: Data Pribadi -->
    <div id="tab1" class="tab-content active">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="bi bi-person me-2"></i>Data Pribadi</h6>
                    </div>
                    <div class="card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Nama Lengkap</div>
                                <div class="info-value">{{ $pendaftaran->nama_lengkap }}</div>
                            </div>
                            <!-- <div class="info-item">
                                <div class="info-label">NIK</div>
                                <div class="info-value">{{ $pendaftaran->nik }}</div>
                            </div> -->
                            <div class="info-item">
                                <div class="info-label">NISN</div>
                                <div class="info-value">{{ $pendaftaran->nisn }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Jenis Kelamin</div>
                                <div class="info-value">{{ $pendaftaran->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Tempat Lahir</div>
                                <div class="info-value">{{ $pendaftaran->tempat_lahir }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Tanggal Lahir</div>
                                <div class="info-value">{{ \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->format('d/m/Y') }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Agama</div>
                                <div class="info-value">{{ $pendaftaran->agama }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">No. HP</div>
                                <div class="info-value">{{ $pendaftaran->handphone }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Email</div>
                                <div class="info-value">{{ $pendaftaran->email }}</div>
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
                                <div class="info-label">Tanggal Daftar</div>
                                <div class="info-value">{{ $pendaftaran->tanggal_pendaftaran ? \Carbon\Carbon::parse($pendaftaran->tanggal_pendaftaran)->format('d/m/Y') : \Carbon\Carbon::parse($pendaftaran->created_at)->format('d/m/Y H:i') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab 2: Alamat Lengkap -->
    <div id="tab2" class="tab-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="bi bi-geo-alt me-2"></i>Alamat Lengkap</h6>
                    </div>
                    <div class="card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Alamat Lengkap</div>
                                <div class="info-value">{{ $pendaftaran->alamat }}</div>
                            </div>      
                            <!-- <div class="info-item">
                                <div class="info-label">RT/RW</div>
                                <div class="info-value">{{ $pendaftaran->rt_rw }}</div>
                            </div> -->
                            <div class="info-item">
                                <div class="info-label">Kelurahan/Desa</div>
                                <div class="info-value">{{ $pendaftaran->kelurahan_desa }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Kecamatan</div>
                                <div class="info-value">{{ $pendaftaran->kecamatan }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Kabupaten/Kota</div>
                                <div class="info-value">{{ $pendaftaran->kabupaten_kota }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Provinsi</div>
                                <div class="info-value">{{ $pendaftaran->provinsi }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Kode Pos</div>
                                <div class="info-value">{{ $pendaftaran->kode_pos }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab 3: Data Orang Tua -->
    <div id="tab3" class="tab-content">
        <div class="row">
            <div class="col-md-6 mb-4">
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
                                <div class="info-label">NIK Ayah</div>
                                <div class="info-value">{{ $pendaftaran->nik_ayah }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Pekerjaan Ayah</div>
                                <div class="info-value">{{ $pendaftaran->pekerjaan_ayah }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Pendidikan Ayah</div>
                                <div class="info-value">{{ $pendaftaran->pendidikan_ayah }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Penghasilan Ayah</div>
                                <div class="info-value">{{ $pendaftaran->penghasilan_ayah }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Telepon Ayah</div>
                                <div class="info-value">{{ $pendaftaran->telepon_ayah }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
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
                                <div class="info-label">NIK Ibu</div>
                                <div class="info-value">{{ $pendaftaran->nik_ibu }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Pekerjaan Ibu</div>
                                <div class="info-value">{{ $pendaftaran->pekerjaan_ibu }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Pendidikan Ibu</div>
                                <div class="info-value">{{ $pendaftaran->pendidikan_ibu }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Penghasilan Ibu</div>
                                <div class="info-value">{{ $pendaftaran->penghasilan_ibu }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Telepon Ibu</div>
                                <div class="info-value">{{ $pendaftaran->telepon_ibu }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab 4: Berkas Dokumen (View & Download) - Includes Photo -->
    <div id="tab4" class="tab-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i>Berkas Dokumen</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Foto Siswa -->
                            <div class="col-md-3 mb-4">
                                <div class="text-center">
                                    <div class="mb-2">
                                        @if($pendaftaran->foto)
                                            <a href="{{ asset('uploads/foto/' . $pendaftaran->foto) }}" target="_blank">
                                                <i class="bi bi-file-earmark-image text-primary fs-1"></i>
                                            </a>
                                        @elseif($pendaftaran->berkas && $pendaftaran->berkas->file_foto)
                                            <a href="{{ asset('storage/' . $pendaftaran->berkas->file_foto) }}" target="_blank">
                                                <i class="bi bi-file-earmark-image text-primary fs-1"></i>
                                            </a>
                                        @else
                                            <i class="bi bi-file-earmark-image text-muted fs-1"></i>
                                        @endif
                                    </div>
                                    <h6>Foto Siswa</h6>
                                    <div class="document-actions">
                                        @if($pendaftaran->foto)
                                            <a href="{{ asset('uploads/foto/' . $pendaftaran->foto) }}" class="btn btn-sm btn-primary btn-sm-custom" target="_blank">
                                                <i class="bi bi-eye"></i> View
                                            </a>
                                            <a href="{{ asset('uploads/foto/' . $pendaftaran->foto) }}" class="btn btn-sm btn-success btn-sm-custom" download>
                                                <i class="bi bi-download"></i> Download
                                            </a>
                                        @elseif($pendaftaran->berkas && $pendaftaran->berkas->file_foto)
                                            <a href="{{ asset('storage/' . $pendaftaran->berkas->file_foto) }}" class="btn btn-sm btn-primary btn-sm-custom" target="_blank">
                                                <i class="bi bi-eye"></i> View
                                            </a>
                                            <a href="{{ asset('storage/' . $pendaftaran->berkas->file_foto) }}" class="btn btn-sm btn-success btn-sm-custom" download>
                                                <i class="bi bi-download"></i> Download
                                            </a>
                                        @else
                                            <span class="text-danger">Belum ada</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Rapot SMP -->
                            <div class="col-md-3 mb-4">
                                <div class="text-center">
                                    <div class="mb-2">
                                        @if($pendaftaran->berkas && $pendaftaran->berkas->file_rapor)
                                            <a href="{{ asset('storage/' . $pendaftaran->berkas->file_rapor) }}" target="_blank">
                                                <i class="bi bi-file-earmark-pdf text-primary fs-1"></i>
                                            </a>
                                        @else
                                            <i class="bi bi-file-earmark-pdf text-muted fs-1"></i>
                                        @endif
                                    </div>
                                    <h6>Ijazah SD</h6>
                                    <div class="document-actions">
                                        @if($pendaftaran->berkas && $pendaftaran->berkas->file_rapor)
                                            <a href="{{ asset('storage/' . $pendaftaran->berkas->file_rapor) }}" class="btn btn-sm btn-primary btn-sm-custom" target="_blank">
                                                <i class="bi bi-eye"></i> View
                                            </a>
                                            <a href="{{ asset('storage/' . $pendaftaran->berkas->file_rapor) }}" class="btn btn-sm btn-success btn-sm-custom" download>
                                                <i class="bi bi-download"></i> Download
                                            </a>
                                        @else
                                            <span class="text-danger">Belum ada</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Kartu Keluarga -->
                            <div class="col-md-3 mb-4">
                                <div class="text-center">
                                    <div class="mb-2">
                                        @if($pendaftaran->berkas && $pendaftaran->berkas->file_kk)
                                            <a href="{{ asset('storage/' . $pendaftaran->berkas->file_kk) }}" target="_blank">
                                                <i class="bi bi-file-earmark-pdf text-primary fs-1"></i>
                                            </a>
                                        @else
                                            <i class="bi bi-file-earmark-pdf text-muted fs-1"></i>
                                        @endif
                                    </div>
                                    <h6>Kartu Keluarga</h6>
                                    <div class="document-actions">
                                        @if($pendaftaran->berkas && $pendaftaran->berkas->file_kk)
                                            <a href="{{ asset('storage/' . $pendaftaran->berkas->file_kk) }}" class="btn btn-sm btn-primary btn-sm-custom" target="_blank">
                                                <i class="bi bi-eye"></i> View
                                            </a>
                                            <a href="{{ asset('storage/' . $pendaftaran->berkas->file_kk) }}" class="btn btn-sm btn-success btn-sm-custom" download>
                                                <i class="bi bi-download"></i> Download
                                            </a>
                                        @else
                                            <span class="text-danger">Belum ada</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Ijazah -->
                            <div class="col-md-3 mb-4">
                                <div class="text-center">
                                    <div class="mb-2">
                                        @if($pendaftaran->berkas && $pendaftaran->berkas->file_ijazah)
                                            <a href="{{ asset('storage/' . $pendaftaran->berkas->file_ijazah) }}" target="_blank">
                                                <i class="bi bi-file-earmark-pdf text-primary fs-1"></i>
                                            </a>
                                        @else
                                            <i class="bi bi-file-earmark-pdf text-muted fs-1"></i>
                                        @endif
                                    </div>
                                    <h6>Ijazah SMP</h6>
                                    <div class="document-actions">
                                        @if($pendaftaran->berkas && $pendaftaran->berkas->file_ijazah)
                                            <a href="{{ asset('storage/' . $pendaftaran->berkas->file_ijazah) }}" class="btn btn-sm btn-primary btn-sm-custom" target="_blank">
                                                <i class="bi bi-eye"></i> View
                                            </a>
                                            <a href="{{ asset('storage/' . $pendaftaran->berkas->file_ijazah) }}" class="btn btn-sm btn-success btn-sm-custom" download>
                                                <i class="bi bi-download"></i> Download
                                            </a>
                                        @else
                                            <span class="text-danger">Belum ada</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Akte Kelahiran -->
                            <div class="col-md-3 mb-4">
                                <div class="text-center">
                                    <div class="mb-2">
                                        @if($pendaftaran->berkas && $pendaftaran->berkas->file_akte)
                                            <a href="{{ asset('storage/' . $pendaftaran->berkas->file_akte) }}" target="_blank">
                                                <i class="bi bi-file-earmark-pdf text-primary fs-1"></i>
                                            </a>
                                        @else
                                            <i class="bi bi-file-earmark-pdf text-muted fs-1"></i>
                                        @endif
                                    </div>
                                    <h6>Akte Kelahiran</h6>
                                    <div class="document-actions">
                                        @if($pendaftaran->berkas && $pendaftaran->berkas->file_akte)
                                            <a href="{{ asset('storage/' . $pendaftaran->berkas->file_akte) }}" class="btn btn-sm btn-primary btn-sm-custom" target="_blank">
                                                <i class="bi bi-eye"></i> View
                                            </a>
                                            <a href="{{ asset('storage/' . $pendaftaran->berkas->file_akte) }}" class="btn btn-sm btn-success btn-sm-custom" download>
                                                <i class="bi bi-download"></i> Download
                                            </a>
                                        @else
                                            <span class="text-danger">Belum ada</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Daftar Kolektif Peserta Ujian -->
                            <div class="col-md-3 mb-4">
                                <div class="text-center">
                                    <div class="mb-2">
                                        @if($pendaftaran->berkas && $pendaftaran->berkas->file_foto)
                                            <a href="{{ asset('storage/' . $pendaftaran->berkas->file_foto) }}" target="_blank">
                                                <i class="bi bi-file-earmark-pdf text-primary fs-1"></i>
                                            </a>
                                        @else
                                            <i class="bi bi-file-earmark-pdf text-muted fs-1"></i>
                                        @endif
                                    </div>
                                    <h6>Daftar Kolektif Peserta Ujian</h6>
                                    <div class="document-actions">
                                        @if($pendaftaran->berkas && $pendaftaran->berkas->file_foto)
                                            <a href="{{ asset('storage/' . $pendaftaran->berkas->file_foto) }}" class="btn btn-sm btn-primary btn-sm-custom" target="_blank">
                                                <i class="bi bi-eye"></i> View
                                            </a>
                                            <a href="{{ asset('storage/' . $pendaftaran->berkas->file_foto) }}" class="btn btn-sm btn-success btn-sm-custom" download>
                                                <i class="bi bi-download"></i> Download
                                            </a>
                                        @else
                                            <span class="text-danger">Belum ada</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Surat Rekomendasi Lulusan -->
                            <div class="col-md-3 mb-4">
                                <div class="text-center">
                                    <div class="mb-2">
                                        @if($pendaftaran->berkas && $pendaftaran->berkas->file_akte)
                                            <a href="{{ asset('storage/' . $pendaftaran->berkas->file_akte) }}" target="_blank">
                                                <i class="bi bi-file-earmark-pdf text-primary fs-1"></i>
                                            </a>
                                        @else
                                            <i class="bi bi-file-earmark-pdf text-muted fs-1"></i>
                                        @endif
                                    </div>
                                    <h6>Surat Rekomendasi Lulusan</h6>
                                    <div class="document-actions">
                                        @if($pendaftaran->berkas && $pendaftaran->berkas->file_akte)
                                            <a href="{{ asset('storage/' . $pendaftaran->berkas->file_akte) }}" class="btn btn-sm btn-primary btn-sm-custom" target="_blank">
                                                <i class="bi bi-eye"></i> View
                                            </a>
                                            <a href="{{ asset('storage/' . $pendaftaran->berkas->file_akte) }}" class="btn btn-sm btn-success btn-sm-custom" download>
                                                <i class="bi bi-download"></i> Download
                                            </a>
                                        @else
                                            <span class="text-danger">Belum ada</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Surat Keterangan Berkelakuan Baik -->
                            <div class="col-md-3 mb-4">
                                <div class="text-center">
                                    <div class="mb-2">
                                        @if($pendaftaran->berkas && $pendaftaran->berkas->file_rapor)
                                            <a href="{{ asset('storage/' . $pendaftaran->berkas->file_rapor) }}" target="_blank">
                                                <i class="bi bi-file-earmark-pdf text-primary fs-1"></i>
                                            </a>
                                        @else
                                            <i class="bi bi-file-earmark-pdf text-muted fs-1"></i>
                                        @endif
                                    </div>
                                    <h6>Surat Keterangan Berkelakuan Baik</h6>
                                    <div class="document-actions">
                                        @if($pendaftaran->berkas && $pendaftaran->berkas->file_rapor)
                                            <a href="{{ asset('storage/' . $pendaftaran->berkas->file_rapor) }}" class="btn btn-sm btn-primary btn-sm-custom" target="_blank">
                                                <i class="bi bi-eye"></i> View
                                            </a>
                                            <a href="{{ asset('storage/' . $pendaftaran->berkas->file_rapor) }}" class="btn btn-sm btn-success btn-sm-custom" download>
                                                <i class="bi bi-download"></i> Download
                                            </a>
                                        @else
                                            <span class="text-danger">Belum ada</span>
                                        @endif
                                    </div>
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