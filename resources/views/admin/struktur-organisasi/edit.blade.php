@extends('admin.layouts.app')

@section('title', 'Edit Struktur Organisasi - Admin')

@section('content')
<div class="container-fluid px-4">

    {{-- Header --}}
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('admin.struktur-organisasi.index') }}" class="btn btn-light border px-3">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h4 class="fw-bold mb-0">Edit Anggota Struktur Organisasi</h4>
            <p class="text-muted mb-0 small">Perbarui data jabatan dan nama</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 14px; overflow: hidden;">
        <div class="card-header border-0 py-3 px-4"
             style="background: linear-gradient(135deg, #fd7e14, #e55a00);">
            <div class="d-flex align-items-center gap-2 text-white">
                <i class="bi bi-pencil-fill fs-5"></i>
                <span class="fw-bold">Edit: {{ $struktur->jabatan }}</span>
            </div>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.struktur-organisasi.update', $struktur->id) }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">

                    {{-- Judul Utama --}}
                    <div class="col-md-6">
                        <label for="judul_utama" class="form-label fw-semibold">
                            <i class="bi bi-type-h1 text-primary me-1"></i>Judul Utama
                        </label>
                        <input type="text"
                               class="form-control @error('judul_utama') is-invalid @enderror"
                               id="judul_utama" name="judul_utama"
                               value="{{ old('judul_utama', $struktur->judul_utama ?? 'STRUKTUR ORGANISASI') }}"
                               placeholder="Contoh: STRUKTUR ORGANISASI"
                               required>
                        @error('judul_utama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Judul yang tampil di atas struktur organisasi.</small>
                    </div>

                    {{-- Sub Judul --}}
                    <div class="col-md-6">
                        <label for="sub_judul" class="form-label fw-semibold">
                            <i class="bi bi-type-h2 text-success me-1"></i>Sub Judul
                        </label>
                        <input type="text"
                               class="form-control @error('sub_judul') is-invalid @enderror"
                               id="sub_judul" name="sub_judul"
                               value="{{ old('sub_judul', $struktur->sub_judul ?? 'SMA NEGERI KARUBAGA') }}"
                               placeholder="Contoh: SMA NEGERI KARUBAGA"
                               required>
                        @error('sub_judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Sub judul yang tampil di bawah judul utama.</small>
                    </div>

                    {{-- Jabatan --}}
                    <div class="col-md-6">
                        <label for="jabatan" class="form-label fw-semibold">
                            <i class="bi bi-briefcase text-primary me-1"></i>Jabatan
                        </label>
                        <input type="text"
                               class="form-control @error('jabatan') is-invalid @enderror"
                               id="jabatan" name="jabatan"
                               value="{{ old('jabatan', $struktur->jabatan) }}"
                               placeholder="Contoh: KEPALA SEKOLAH"
                               required>
                        @error('jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Tulis jabatan dengan huruf kapital.</small>
                    </div>

                    {{-- Nama --}}
                    <div class="col-md-6">
                        <label for="nama" class="form-label fw-semibold">
                            <i class="bi bi-person text-success me-1"></i>Nama Lengkap
                        </label>
                        <input type="text"
                               class="form-control @error('nama') is-invalid @enderror"
                               id="nama" name="nama"
                               value="{{ old('nama', $struktur->nama) }}"
                               placeholder="Contoh: Dra. Maria Kogoya, M.Pd"
                               required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Urutan --}}
                    <div class="col-md-6">
                        <label for="urutan" class="form-label fw-semibold">
                            <i class="bi bi-sort-numeric-up text-warning me-1"></i>Urutan Tampil
                        </label>
                        <input type="number"
                               class="form-control @error('urutan') is-invalid @enderror"
                               id="urutan" name="urutan"
                               value="{{ old('urutan', $struktur->urutan) }}"
                               min="0" required>
                        @error('urutan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">
                            <strong>0</strong> = Kepala Sekolah (paling atas).
                            Angka lebih besar = posisi lebih bawah.
                        </small>
                    </div>

                    {{-- Foto --}}
                    <div class="col-md-6">
                        <label for="foto" class="form-label fw-semibold">
                            <i class="bi bi-image text-info me-1"></i>Foto
                            <small class="text-muted fw-normal">(kosongkan jika tidak ingin mengubah)</small>
                        </label>

                        {{-- Foto saat ini --}}
                        <div class="mb-2">
                            @if($struktur->foto)
                                <img src="{{ asset('storage/'.$struktur->foto) }}"
                                     alt="Foto saat ini"
                                     id="previewImg"
                                     style="width:100px;height:100px;border-radius:50%;object-fit:cover;border:3px solid #2c5282;">
                                <small class="d-block text-muted mt-1">Foto saat ini</small>
                            @else
                                <div id="previewWrapper" style="display:none;">
                                    <img id="previewImg" src="" alt="Preview"
                                         style="width:100px;height:100px;border-radius:50%;object-fit:cover;border:3px solid #2c5282;">
                                    <small class="d-block text-muted mt-1">Preview foto baru</small>
                                </div>
                            @endif
                        </div>

                        <input type="file"
                               class="form-control @error('foto') is-invalid @enderror"
                               id="foto" name="foto"
                               accept="image/jpg,image/jpeg,image/png,image/webp"
                               onchange="previewFoto(this)">
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Format: JPG, PNG, WEBP. Maks 2MB.</small>
                    </div>

                    {{-- Teks di Bawah Foto --}}
                    <div class="col-12">
                        <label for="teks_bawah_foto" class="form-label fw-semibold">
                            <i class="bi bi-card-text text-warning me-1"></i>Teks di Bawah Foto
                        </label>
                        <textarea
                               class="form-control @error('teks_bawah_foto') is-invalid @enderror"
                               id="teks_bawah_foto" name="teks_bawah_foto"
                               rows="6"
                               placeholder="Tulis teks deskripsi atau informasi tambahan di sini (bebas tanpa batas karakter)">{{ old('teks_bawah_foto', $struktur->teks_bawah_foto) }}</textarea>
                        @error('teks_bawah_foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Teks deskripsi yang tampil terpisah di bawah foto dan nama (bebas tanpa batas karakter).</small>
                    </div>

                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <a href="{{ route('admin.struktur-organisasi.index') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                    <button type="submit" class="btn btn-warning text-white px-5">
                        <i class="bi bi-save me-2"></i>Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
function previewFoto(input) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        // Coba tampilkan di img yang sudah ada
        let img = document.getElementById('previewImg');
        if (!img) {
            // Buat elemen baru jika belum ada
            const wrapper = document.getElementById('previewWrapper');
            if (wrapper) {
                wrapper.style.display = 'block';
                img = document.getElementById('previewImg');
            }
        }
        if (img) img.src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
}
</script>
@endpush
