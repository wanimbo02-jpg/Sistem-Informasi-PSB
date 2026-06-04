@extends('admin.layouts.app')

@section('title', 'Tambah Visi Misi - Admin')

@section('content')
<div class="container-fluid px-4">

    {{-- Header --}}
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('admin.visi-misi.index') }}" class="btn btn-light border px-3">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h4 class="fw-bold mb-0">Tambah Visi & Misi</h4>
            <p class="text-muted mb-0 small">Isi visi dan misi sekolah dengan lengkap</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 14px; overflow: hidden;">
        <div class="card-header border-0 py-3 px-4" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
            <div class="d-flex align-items-center gap-2 text-white">
                <i class="bi bi-plus-circle-fill fs-5"></i>
                <span class="fw-bold">Formulir Visi & Misi</span>
            </div>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.visi-misi.store') }}" method="POST">
                @csrf
                <div class="row g-4">

                    {{-- Visi --}}
                    <div class="col-md-6">
                        <label for="visi" class="form-label fw-semibold">
                            <i class="bi bi-eye text-primary me-1"></i>Visi Sekolah
                        </label>
                        <textarea class="form-control @error('visi') is-invalid @enderror"
                                  id="visi" name="visi" rows="8"
                                  placeholder="Masukkan visi sekolah..."
                                  required>{{ old('visi') }}</textarea>
                        @error('visi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Tuliskan visi sekolah secara singkat dan jelas.</small>
                    </div>

                    {{-- Misi --}}
                    <div class="col-md-6">
                        <label for="misi" class="form-label fw-semibold">
                            <i class="bi bi-list-check text-success me-1"></i>Misi Sekolah
                        </label>
                        <textarea class="form-control @error('misi') is-invalid @enderror"
                                  id="misi" name="misi" rows="8"
                                  placeholder="Masukkan misi sekolah (satu baris per poin)..."
                                  required>{{ old('misi') }}</textarea>
                        @error('misi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Pisahkan setiap poin misi dengan baris baru (Enter).</small>
                    </div>

                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <a href="{{ route('admin.visi-misi.index') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary px-5">
                        <i class="bi bi-save me-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
