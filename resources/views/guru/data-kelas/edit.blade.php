@extends('guru.layouts.app')

@section('title', 'Edit Kelas - PPDB')

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
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-dark">Edit Kelas</h1>
            <p class="text-muted">Edit data kelas SMAN Karubaga</p>
        </div>
        <div>
            <a href="{{ route('guru.data-kelas.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="bi bi-pencil me-2"></i>
                Form Edit Kelas
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('guru.data-kelas.update', $kelas->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_kelas" class="form-label">Nama Kelas <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" 
                               value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required placeholder="Contoh: X IPA 1">
                        @error('nama_kelas')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="jurusan" class="form-label">Jurusan <span class="text-danger">*</span></label>
                        <select class="form-select" id="jurusan" name="jurusan" required>
                            <option value="">Pilih Jurusan</option>
                            <option value="IPA" {{ old('jurusan', $kelas->jurusan) == 'IPA' ? 'selected' : '' }}>IPA</option>
                            <option value="IPS" {{ old('jurusan', $kelas->jurusan) == 'IPS' ? 'selected' : '' }}>IPS</option>
                        </select>
                        @error('jurusan')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="wali_kelas" class="form-label">Wali Kelas <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="wali_kelas" name="wali_kelas" 
                               value="{{ old('wali_kelas', $kelas->wali_kelas) }}" required placeholder="Contoh: Dr. Budi Santoso, S.Pd.">
                        @error('wali_kelas')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="semester" class="form-label">Semester <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="semester" name="semester" 
                               value="{{ old('semester', $kelas->semester) }}" required placeholder="Contoh: Ganjil 2025/2026">
                        @error('semester')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="total_siswa" class="form-label">Total Siswa <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="total_siswa" name="total_siswa" 
                               value="{{ old('total_siswa', $kelas->total_siswa) }}" required min="0" placeholder="0">
                        @error('total_siswa')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="laki_laki" class="form-label">Laki-laki <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="laki_laki" name="laki_laki" 
                               value="{{ old('laki_laki', $kelas->laki_laki) }}" required min="0" placeholder="0">
                        @error('laki_laki')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="perempuan" class="form-label">Perempuan <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="perempuan" name="perempuan" 
                               value="{{ old('perempuan', $kelas->perempuan) }}" required min="0" placeholder="0">
                        @error('perempuan')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" 
                              placeholder="Deskripsi singkat tentang kelas...">{{ old('deskripsi', $kelas->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('guru.data-kelas.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Auto calculate total siswa
    document.getElementById('laki_laki').addEventListener('input', function() {
        calculateTotal();
    });
    
    document.getElementById('perempuan').addEventListener('input', function() {
        calculateTotal();
    });
    
    function calculateTotal() {
        const lakiLaki = parseInt(document.getElementById('laki_laki').value) || 0;
        const perempuan = parseInt(document.getElementById('perempuan').value) || 0;
        const total = lakiLaki + perempuan;
        document.getElementById('total_siswa').value = total;
    }
</script>
@endsection
