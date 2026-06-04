@extends('guru.layouts.app')

@section('title', 'Edit Guru - PPDB')

@section('styles')
<style>
    .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border-radius: 15px;
    }
    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #dee2e6;
        padding: 0.75rem;
    }
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    .btn-primary {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
        border-radius: 8px;
        padding: 0.75rem 2rem;
    }
    .btn-primary:hover {
        background: linear-gradient(135deg, #764ba2, #667eea);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }
    .teacher-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: #6c757d;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 2rem;
        margin-bottom: 1rem;
    }
</style>
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-dark">Edit Guru</h1>
            <p class="text-muted">Edit data guru yang terdaftar</p>
        </div>
        <div>
            <a href="{{ route('guru.data-guru.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- Form Edit Guru -->
    <div class="card shadow">
        <div class="card-header bg-white">
            <h6 class="m-0 fw-bold text-dark">Form Edit Data Guru</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('guru.data-guru.update', $guru->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="text-center">
                            @if(isset($guru->foto) && $guru->foto)
                                <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto Guru" class="teacher-avatar">
                            @else
                                <div class="teacher-avatar">
                                    {{ substr($guru->nama_lengkap, 0, 2) }}
                                </div>
                            @endif
                            <div>
                                <label for="foto" class="form-label">Foto Guru</label>
                                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                                <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $guru->nama_lengkap) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip', $guru->nip) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $guru->email) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telepon" class="form-label">Telepon</label>
                                <input type="tel" class="form-control" id="telepon" name="telepon" value="{{ old('telepon', $guru->telepon) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="aktif" {{ $guru->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="tidak-aktif" {{ $guru->status == 'tidak-aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="mata_pelajaran" class="form-label">Mata Pelajaran</label>
                                <input type="text" class="form-control" id="mata_pelajaran" name="mata_pelajaran" value="{{ old('mata_pelajaran', $guru->mata_pelajaran) }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $guru->tanggal_lahir ? $guru->tanggal_lahir->format('Y-m-d') : '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tahun_masuk" class="form-label">Tahun Masuk</label>
                        <input type="number" class="form-control" id="tahun_masuk" name="tahun_masuk" value="{{ old('tahun_masuk', $guru->tahun_masuk) }}" min="2000" max="{{ date('Y') }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                        <input type="text" class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir" value="{{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L" {{ $guru->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ $guru->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="alamat" class="form-label">Alamat Lengkap</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $guru->alamat) }}</textarea>
                    </div>
                </div>
                            <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('guru.data-guru.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Update Data Guru
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
