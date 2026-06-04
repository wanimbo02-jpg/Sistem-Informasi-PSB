@extends('guru.layouts.app')

@section('title', 'Edit Data Siswa - PPDB')

@section('styles')
<style>
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #5a6fd8, #6a4190);
        transform: translateY(-1px);
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark">Edit Data Siswa</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('guru.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('guru.data-siswa.index') }}" class="text-decoration-none">Data Siswa</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0">Form Edit Data Siswa</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('guru.data-siswa.update', $pendaftaran->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $pendaftaran->nama_lengkap) }}" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="nisn" class="form-label">NISN</label>
                                <input type="text" class="form-control" id="nisn" name="nisn" value="{{ old('nisn', $pendaftaran->nisn) }}" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="L" {{ old('jenis_kelamin', $pendaftaran->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin', $pendaftaran->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                                <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" value="{{ old('asal_sekolah', $pendaftaran->asal_sekolah) }}" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="pending" {{ old('status', $pendaftaran->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="verifikasi" {{ old('status', $pendaftaran->status) == 'verifikasi' ? 'selected' : '' }}>Verifikasi</option>
                                    <option value="Lulus seleksi administrasi" {{ old('status', $pendaftaran->status) == 'Lulus seleksi administrasi' ? 'selected' : '' }}>Lulus seleksi administrasi</option>
                                    <option value="Tidak lulus seleksi administrasi" {{ old('status', $pendaftaran->status) == 'Tidak lulus seleksi administrasi' ? 'selected' : '' }}>Tidak lulus seleksi administrasi</option>
                                    <option value="diterima" {{ old('status', $pendaftaran->status) == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                    <option value="ditolak" {{ old('status', $pendaftaran->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select class="form-select" id="kelas" name="kelas">
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
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('guru.data-siswa.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Update Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
