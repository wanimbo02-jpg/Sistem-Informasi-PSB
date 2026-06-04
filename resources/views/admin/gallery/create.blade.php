@extends('admin.layouts.app')

@section('title', 'Tambah Gallery - Admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Gallery Baru
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul Gallery *</label>
                                    <input type="text" 
                                           class="form-control @error('title') is-invalid @enderror" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title') }}" 
                                           placeholder="Masukkan judul gallery"
                                           required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi *</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" 
                                              name="description" 
                                              rows="6" 
                                              placeholder="Deskripsikan kegiatan atau acara ini"
                                              required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="event_date" class="form-label">Tanggal Kegiatan *</label>
                                            <input type="date" 
                                                   class="form-control @error('event_date') is-invalid @enderror" 
                                                   id="event_date" 
                                                   name="event_date" 
                                                   value="{{ old('event_date') }}" 
                                                   required>
                                            @error('event_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="event_category" class="form-label">Kategori Kegiatan *</label>
                                            <select class="form-select @error('event_category') is-invalid @enderror" 
                                                    id="event_category" 
                                                    name="event_category" 
                                                    required>
                                                <option value="">-- Pilih Kategori --</option>
                                                <option value="Akademik" {{ old('event_category') == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                                                <option value="Olahraga" {{ old('event_category') == 'Olahraga' ? 'selected' : '' }}>Olahraga</option>
                                                <option value="Seni & Budaya" {{ old('event_category') == 'Seni & Budaya' ? 'selected' : '' }}>Seni & Budaya</option>
                                                <option value="Sosial" {{ old('event_category') == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                                                <option value="Teknologi" {{ old('event_category') == 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
                                                <option value="Lainnya" {{ old('event_category') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                            </select>
                                            @error('event_category')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="location" class="form-label">Lokasi</label>
                                    <input type="text" 
                                           class="form-control @error('location') is-invalid @enderror" 
                                           id="location" 
                                           name="location" 
                                           value="{{ old('location') }}" 
                                           placeholder="Lokasi kegiatan (opsional)">
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               id="is_active" 
                                               name="is_active" 
                                               value="1" 
                                               checked>
                                        <label class="form-check-label" for="is_active">
                                            Tampilkan di halaman publik
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Gambar Gallery *</label>
                                    <input type="file" 
                                           class="form-control @error('image') is-invalid @enderror" 
                                           id="image" 
                                           name="image" 
                                           accept="image/*"
                                           required>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">
                                        Format: JPEG, PNG, JPG, GIF (Max: 2MB)
                                    </small>
                                </div>

                                <div class="mb-3">
                                    <div class="text-center">
                                        <div id="imagePreview" class="mb-3"></div>
                                        <small class="text-muted">Preview gambar akan muncul di sini</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left me-2"></i>Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Simpan Gallery
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    #imagePreview img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .form-label {
        font-weight: 600;
        color: #495057;
    }
    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: 1px solid rgba(0, 0, 0, 0.125);
    }
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    }
</style>
@endpush

@push('scripts')
<script>
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('imagePreview');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `
                    <img src="${e.target.result}" alt="Preview" style="max-height: 200px;">
                `;
            }
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '';
        }
    });
</script>
@endpush
