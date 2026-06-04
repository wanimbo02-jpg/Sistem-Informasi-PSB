@extends('admin.layouts.app')

@section('title', 'Tambah Fasilitas - Admin')

@section('content')
<div class="container-fluid px-4">

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-light border px-3">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h4 class="fw-bold mb-0">Tambah Fasilitas</h4>
            <p class="text-muted mb-0 small">Upload foto dan informasi fasilitas sekolah</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 14px; overflow: hidden;">
        <div class="card-header border-0 py-3 px-4" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
            <div class="d-flex align-items-center gap-2 text-white">
                <i class="bi bi-building fs-5"></i>
                <span class="fw-bold">Formulir Fasilitas Baru</span>
            </div>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                <i class="bi bi-building text-primary me-1"></i>Nama Fasilitas *
                            </label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                   name="nama" value="{{ old('nama') }}"
                                   placeholder="Contoh: Laboratorium Komputer" required>
                            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                <i class="bi bi-text-paragraph text-primary me-1"></i>Deskripsi *
                            </label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                      name="deskripsi" rows="5"
                                      placeholder="Deskripsikan fasilitas ini..."
                                      required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" checked>
                                <label class="form-check-label small" for="is_active">
                                    Tampilkan di halaman publik
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                <i class="bi bi-image text-primary me-1"></i>Foto Fasilitas *
                            </label>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                   name="gambar" id="gambar" accept="image/*" required>
                            @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <small class="text-muted">Format: JPEG, PNG, JPG, GIF (Max: 2MB)</small>
                        </div>
                        <div id="preview" class="text-center mt-2" style="display:none;">
                            <img id="previewImg" src="" alt="Preview"
                                 class="img-fluid rounded-3 shadow-sm" style="max-height: 200px; object-fit: cover;">
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary px-5">
                        <i class="bi bi-save me-2"></i>Simpan Fasilitas
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.getElementById('gambar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('preview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
