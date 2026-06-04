@extends('guru.layouts.app')

@section('title', 'Tambah Pengumuman - Guru')

@section('content')
<div class="container-fluid px-4">

    {{-- Header --}}
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('guru.pengumuman.index') }}" class="btn btn-light border px-3">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h4 class="fw-bold mb-0">Tambah Pengumuman</h4>
            <p class="text-muted mb-0 small">Isi data pengumuman untuk publik</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 14px; overflow: hidden;">
        <div class="card-header border-0 py-3 px-4" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
            <div class="d-flex align-items-center gap-2 text-white">
                <i class="bi bi-plus-circle-fill fs-5"></i>
                <span class="fw-bold">Formulir Tambah Pengumuman</span>
            </div>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('guru.pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">

                    {{-- Jenis Pengumuman --}}
                    <div class="col-md-12">
                        <label for="jenis_pengumuman" class="form-label fw-semibold">
                            <i class="bi bi-list-check text-primary me-1"></i>Jenis Pengumuman
                        </label>
                        <select class="form-select @error('jenis_pengumuman') is-invalid @enderror"
                                id="jenis_pengumuman" name="jenis_pengumuman" required>
                            <option value="">-- Pilih Jenis Pengumuman --</option>
                            <option value="seleksi_administrasi" {{ old('jenis_pengumuman', request('jenis')) == 'seleksi_administrasi' ? 'selected' : '' }}>
                                Hasil Seleksi Administrasi
                            </option>
                            <option value="pengumuman_final" {{ old('jenis_pengumuman', request('jenis')) == 'pengumuman_final' ? 'selected' : '' }}>
                                Hasil Pengumuman Final
                            </option>
                        </select>
                        @error('jenis_pengumuman')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Pilih jenis pengumuman yang akan ditambahkan.</small>
                    </div>

                    {{-- Judul --}}
                    <div class="col-md-12">
                        <label for="judul" class="form-label fw-semibold">
                            <i class="bi bi-type-h1 text-primary me-1"></i>Judul
                        </label>
                        <input type="text"
                               class="form-control @error('judul') is-invalid @enderror"
                               id="judul" name="judul"
                               value="{{ old('judul') }}"
                               placeholder="Contoh: Hasil Seleksi PPDB"
                               required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Judul utama pengumuman.</small>
                    </div>

                    {{-- Sub Judul --}}
                    <div class="col-md-12">
                        <label for="sub_judul" class="form-label fw-semibold">
                            <i class="bi bi-type-h2 text-success me-1"></i>Sub Judul
                        </label>
                        <input type="text"
                               class="form-control @error('sub_judul') is-invalid @enderror"
                               id="sub_judul" name="sub_judul"
                               value="{{ old('sub_judul') }}"
                               placeholder="Contoh: Tahun Ajaran 2026/2027">
                        @error('sub_judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Sub judul atau keterangan tambahan.</small>
                    </div>

                    {{-- Tahun Ajaran --}}
                    <div class="col-md-6">
                        <label for="tahun_ajaran" class="form-label fw-semibold">
                            <i class="bi bi-calendar text-warning me-1"></i>Tahun Ajaran
                        </label>
                        <input type="text"
                               class="form-control @error('tahun_ajaran') is-invalid @enderror"
                               id="tahun_ajaran" name="tahun_ajaran"
                               value="{{ old('tahun_ajaran') }}"
                               placeholder="Contoh: 2026/2027">
                        @error('tahun_ajaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Tahun ajaran berlaku.</small>
                    </div>

                    {{-- File --}}
                    <div class="col-md-6">
                        <label for="file" class="form-label fw-semibold">
                            <i class="bi bi-file-earmark text-info me-1"></i>File (Word/Excel/PDF)
                        </label>
                        <input type="file"
                               class="form-control @error('file') is-invalid @enderror"
                               id="file" name="file"
                               accept=".doc,.docx,.xls,.xlsx,.pdf">
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Format: DOC, DOCX, XLS, XLSX, PDF. Maks 5MB.</small>
                    </div>

                    {{-- Isi --}}
                    <div class="col-12">
                        <label for="isi" class="form-label fw-semibold">
                            <i class="bi bi-card-text text-secondary me-1"></i>Isi Pengumuman
                        </label>
                        <textarea
                               class="form-control @error('isi') is-invalid @enderror"
                               id="isi" name="isi"
                               rows="5"
                               placeholder="Tulis isi pengumuman di sini (opsional)">{{ old('isi') }}</textarea>
                        @error('isi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Isi teks pengumuman (opsional jika ada file).</small>
                    </div>

                    {{-- Aktif --}}
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input @error('aktif') is-invalid @enderror"
                                   type="checkbox"
                                   id="aktif" name="aktif"
                                   value="1"
                                   {{ old('aktif', '1') ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="aktif">
                                <i class="bi bi-check-circle text-success me-1"></i>Aktif
                            </label>
                            @error('aktif')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @endif
                            <small class="text-muted d-block mt-1">Centang untuk menampilkan pengumuman di halaman publik.</small>
                        </div>
                    </div>

                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <a href="{{ route('guru.pengumuman.index') }}" class="btn btn-secondary px-4">
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
