@extends('admin.layouts.app')

@section('title', 'Detail Fasilitas - Admin')

@section('content')
<div class="container-fluid px-4">

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-light border px-3">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h4 class="fw-bold mb-0">Detail Fasilitas</h4>
            <p class="text-muted mb-0 small">Informasi lengkap fasilitas sekolah</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 14px; overflow: hidden;">
        <div class="card-header border-0 py-3 px-4" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
            <div class="d-flex align-items-center gap-2 text-white">
                <i class="bi bi-building fs-5"></i>
                <span class="fw-bold">{{ $fasilitas->nama }}</span>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="row g-4">

                {{-- Gambar --}}
                <div class="col-md-5">
                    <img src="{{ asset('storage/' . $fasilitas->gambar) }}"
                         alt="{{ $fasilitas->nama }}"
                         class="img-fluid rounded-3 shadow-sm w-100"
                         style="max-height: 320px; object-fit: cover;">
                </div>

                {{-- Info --}}
                <div class="col-md-7">
                    <table class="table table-borderless">
                        <tr>
                            <td class="fw-semibold text-muted" style="width: 140px;">Nama Fasilitas</td>
                            <td>: <span class="fw-bold">{{ $fasilitas->nama }}</span></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-muted">Status</td>
                            <td>:
                                @if($fasilitas->is_active)
                                    <span class="badge bg-success rounded-pill px-3">Aktif</span>
                                @else
                                    <span class="badge bg-secondary rounded-pill px-3">Nonaktif</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-muted">Ditambahkan</td>
                            <td>: {{ $fasilitas->created_at->format('d F Y, H:i') }}</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-muted align-top">Deskripsi</td>
                            <td>: <span class="text-secondary">{{ $fasilitas->deskripsi }}</span></td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
        <div class="card-footer bg-white border-top d-flex justify-content-between align-items-center px-4 py-3">
            <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-secondary px-4">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.fasilitas.edit', $fasilitas->id) }}" class="btn btn-warning text-white px-4">
                    <i class="bi bi-pencil me-2"></i>Edit
                </a>
                <form action="{{ route('admin.fasilitas.destroy', $fasilitas->id) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus fasilitas ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4">
                        <i class="bi bi-trash me-2"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
