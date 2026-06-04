@extends('admin.layouts.app')

@section('title', 'Edit Fasilitas - Admin')

@section('content')
<div class="container-fluid px-4">

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-light border px-3">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h4 class="fw-bold mb-0">Edit Fasilitas</h4>
            <p class="text-muted mb-0 small">Perbarui informasi fasilitas sekolah</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 14px; overflow: hidden;">
        <div class="card-header border-0 py-3 px-4" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
            <div class="d-flex align-items-center gap-2 text-white">
                <i class="bi bi-pencil-fill fs-5"></i>
                <span class="fw-bold">Edit: {{ $fasilitas->nama }}</span>
            </div>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.fasilitas.update', $fasilitas->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="row g-4">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                <i class="bi bi-building text-warning me-1"></i>Nama Fasilitas *
                            </label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                   name="nama" value="{{ old('nama', $fasilitas->nama) }}" required>
                            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                <i class="bi bi-text-paragraph text-warning me-1"></i>Deskripsi *
                            </label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                      name="deskripsi" rows="5"
                                      required>{{ old('deskripsi', $fasilitas->deskripsi) }}</textarea>
                            @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                       id="is_active" {{ $fasilitas->is_active ? 'checked' : '' }}>
                                <label class="form-check-label small" for="is_active">
                                    Tampilkan di halaman publik
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                <i class="bi bi-image text-warning me-1"></i>Ganti Foto
                            </label>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                   name="gambar" id="gambar" accept="image/*">
                            @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                        </div>
                        <div class="text-center">
                            <img id="previewImg" src="{{ asset('storage/' . $fasilitas->gambar) }}"
                                 alt="{{ $fasilitas->nama }}"
                                 class="img-fluid rounded-3 shadow-sm" style="max-height: 200px; object-fit: cover;">
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                    <button type="submit" class="btn btn-warning text-white px-5">
                        <i class="bi bi-save me-2"></i>Simpan Perubahan
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
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
