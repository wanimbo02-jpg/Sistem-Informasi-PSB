@extends('guru.layouts.app')

@section('title', 'Tambah Mata Pelajaran - PPDB')

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
    
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
    
    .card-header {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border-radius: 15px 15px 0 0;
        border: none;
    }
    
    .upload-preview {
        width: 120px;
        height: 120px;
        border: 2px dashed #dee2e6;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .upload-preview:hover {
        border-color: #667eea;
        background: #f8f9fa;
    }
    
    .upload-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-dark">Tambah Mata Pelajaran</h1>
            <p class="text-muted">Tambah data mata pelajaran baru SMAN Karubaga</p>
        </div>
        <div>
            <a href="{{ route('guru.data-mata-pelajaran.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="bi bi-plus-circle me-2"></i>
                Form Tambah Mata Pelajaran
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('guru.data-mata-pelajaran.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_mapel" class="form-label">Nama Mata Pelajaran <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" 
                               value="{{ old('nama_mapel') }}" required placeholder="Contoh: Matematika">
                        @error('nama_mapel')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="code_mapel" class="form-label">Kode Mata Pelajaran <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="code_mapel" name="code_mapel" 
                               value="{{ old('code_mapel') }}" required placeholder="Contoh: MTK001">
                        @error('code_mapel')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_pengajar" class="form-label">Nama Pengajar <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_pengajar" name="nama_pengajar" 
                               value="{{ old('nama_pengajar') }}" required placeholder="Contoh: Dr. Budi Santoso, M.Pd.">
                        @error('nama_pengajar')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="nip_pengajar" class="form-label">NIP Pengajar <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nip_pengajar" name="nip_pengajar" 
                               value="{{ old('nip_pengajar') }}" required placeholder="Contoh: 198501012015031001">
                        @error('nip_pengajar')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="foto_pengajar" class="form-label">Foto Pengajar</label>
                        <div class="upload-preview" onclick="document.getElementById('foto_pengajar').click()">
                            <div id="preview-container">
                                <i class="bi bi-camera fs-1 text-muted"></i>
                                <p class="text-muted small mb-0">Klik untuk upload foto</p>
                            </div>
                        </div>
                        <input type="file" class="form-control d-none" id="foto_pengajar" name="foto_pengajar" 
                               accept="image/jpeg,image/png,image/jpg" onchange="previewImage(event)">
                        @error('foto_pengajar')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak aktif" {{ old('status') == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('guru.data-mata-pelajaran.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview-container');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview">';
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
