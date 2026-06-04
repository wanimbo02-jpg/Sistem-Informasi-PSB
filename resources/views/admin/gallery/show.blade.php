@extends('admin.layouts.app')

@section('title', 'Detail Gallery - Admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-images me-2"></i>Detail Gallery: {{ $gallery->title }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h6 class="text-muted mb-2">Judul Gallery</h6>
                                <h4>{{ $gallery->title }}</h4>
                            </div>

                            <div class="mb-4">
                                <h6 class="text-muted mb-2">Deskripsi</h6>
                                <p>{{ $gallery->description }}</p>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h6 class="text-muted mb-2">Tanggal Kegiatan</h6>
                                        <span class="badge bg-primary fs-6">{{ $gallery->formatted_date }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h6 class="text-muted mb-2">Kategori</h6>
                                        <span class="badge bg-info fs-6">{{ $gallery->event_category }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h6 class="text-muted mb-2">Lokasi</h6>
                                        <p>{{ $gallery->location ?? 'Tidak diset' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h6 class="text-muted mb-2">Status</h6>
                                        @if($gallery->is_active)
                                            <span class="badge bg-success fs-6">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary fs-6">Tidak Aktif</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h6 class="text-muted mb-2">Dilihat</h6>
                                        <p><i class="fas fa-eye me-2"></i>{{ $gallery->views }} kali</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h6 class="text-muted mb-2">Dibuat</h6>
                                        <p>{{ $gallery->created_at->format('d F Y, H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-4">
                                <h6 class="text-muted mb-2">Gambar Gallery</h6>
                                <img src="{{ asset('storage/' . $gallery->image) }}" 
                                     alt="{{ $gallery->title }}" 
                                     class="img-fluid rounded shadow-sm">
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ route('admin.gallery.edit', $gallery) }}" class="btn btn-warning">
                                    <i class="fas fa-edit me-2"></i>Edit Gallery
                                </a>
                                <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-danger w-100"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus gallery ini?')">
                                        <i class="fas fa-trash me-2"></i>Hapus Gallery
                                    </button>
                                </form>
                                <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .badge {
        font-size: 0.8rem;
    }
    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: 1px solid rgba(0, 0, 0, 0.125);
    }
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    }
    .img-fluid {
        max-width: 100%;
        height: auto;
    }
</style>
@endpush
