@extends('siswa.layouts.app')

@section('title', 'Edit Profile Siswa')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Profile Siswa</h1>
        <div>
            <a href="{{ route('siswa.profile.index') }}" class="btn btn-sm btn-info">
                <i class="bi bi-eye"></i> Lihat Profile
            </a>
            <a href="{{ route('siswa.dashboard') }}" class="btn btn-sm btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header bg-warning text-white">
                    <h6 class="m-0 font-weight-bold">Form Edit Data Diri Siswa</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('siswa.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Data Pribadi -->
                        <h6 class="text-warning mb-3">A. Data Pribadi</h6>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">NISN <span class="text-danger">*</span></label>
                                <input type="text" name="nisn" class="form-control @error('nisn') is-invalid @enderror"
                                       value="{{ old('nisn', $siswa->nisn) }}" maxlength="10">
                                @error('nisn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">NIK <span class="text-danger">*</span></label>
                                <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror"
                                       value="{{ old('nik', $siswa->nik) }}" maxlength="16">
                                @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                       value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}">
                                @error('tempat_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                       value="{{ old('tanggal_lahir', $siswa->tanggal_lahir->format('Y-m-d')) }}">
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                    <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Agama <span class="text-danger">*</span></label>
                                <select name="agama" class="form-select @error('agama') is-invalid @enderror">
                                    <option value="Islam" {{ old('agama', $siswa->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('agama', $siswa->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ old('agama', $siswa->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('agama', $siswa->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('agama', $siswa->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ old('agama', $siswa->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select>
                                @error('agama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Asal Sekolah <span class="text-danger">*</span></label>
                            <input type="text" name="asal_sekolah" class="form-control @error('asal_sekolah') is-invalid @enderror"
                                   value="{{ old('asal_sekolah', $siswa->asal_sekolah) }}">
                            @error('asal_sekolah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        <!-- Data Orang Tua -->
                        <h6 class="text-warning mb-3">B. Data Orang Tua/Wali</h6>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Ayah <span class="text-danger">*</span></label>
                                <input type="text" name="nama_ayah" class="form-control @error('nama_ayah') is-invalid @enderror"
                                       value="{{ old('nama_ayah', $siswa->nama_ayah) }}">
                                @error('nama_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Pekerjaan Ayah</label>
                                <input type="text" name="pekerjaan_ayah" class="form-control @error('pekerjaan_ayah') is-invalid @enderror"
                                       value="{{ old('pekerjaan_ayah', $siswa->pekerjaan_ayah) }}">
                                @error('pekerjaan_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Ibu <span class="text-danger">*</span></label>
                                <input type="text" name="nama_ibu" class="form-control @error('nama_ibu') is-invalid @enderror"
                                       value="{{ old('nama_ibu', $siswa->nama_ibu) }}">
                                @error('nama_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Pekerjaan Ibu</label>
                                <input type="text" name="pekerjaan_ibu" class="form-control @error('pekerjaan_ibu') is-invalid @enderror"
                                       value="{{ old('pekerjaan_ibu', $siswa->pekerjaan_ibu) }}">
                                @error('pekerjaan_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No. HP Orang Tua <span class="text-danger">*</span></label>
                            <input type="text" name="no_hp_ortu" class="form-control @error('no_hp_ortu') is-invalid @enderror"
                                   value="{{ old('no_hp_ortu', $siswa->no_hp_ortu) }}">
                            @error('no_hp_ortu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat Orang Tua <span class="text-danger">*</span></label>
                            <textarea name="alamat_ortu" rows="3" class="form-control @error('alamat_ortu') is-invalid @enderror">{{ old('alamat_ortu', $siswa->alamat_ortu) }}</textarea>
                            @error('alamat_ortu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        <!-- Foto -->
                        <h6 class="text-warning mb-3">C. Foto Profile</h6>

                        <div class="row">
                            <div class="col-md-4 text-center mb-3">
                                @if($user->foto)
                                    <img src="{{ asset('storage/'.$user->foto) }}" class="img-fluid rounded border mb-2" style="max-height: 150px;">
                                @else
                                    <div class="bg-light p-3 rounded mb-2">
                                        <i class="bi bi-person-circle fs-1 text-muted"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <label class="form-label">Ganti Foto</label>
                                <input type="file" name="foto_siswa" class="form-control @error('foto_siswa') is-invalid @enderror"
                                       accept="image/*" id="foto">
                                @error('foto_siswa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Kosongkan jika tidak ingin mengganti foto</small>
                                <div id="preview-container" style="display: none;" class="mt-2">
                                    <img id="preview" src="#" class="img-fluid rounded border" style="max-height: 100px;">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Ubah Password -->
                        <h6 class="text-warning mb-3">D. Ubah Password</h6>

                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> Kosongkan jika tidak ingin mengubah password
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password Saat Ini</label>
                            <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Password Baru</label>
                                <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror">
                                @error('new_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" name="new_password_confirmation" class="form-control">
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-secondary me-2">
                                <i class="bi bi-arrow-counterclockwise"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-warning px-4">
                                <i class="bi bi-save"></i> Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header bg-warning text-white">
                    <h6 class="m-0 font-weight-bold">Informasi</h6>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle"></i>
                        <strong>Perhatian!</strong>
                        <ul class="mb-0 mt-2">
                            <li>Pastikan data yang diubah sudah benar</li>
                            <li>Perubahan data akan mempengaruhi proses verifikasi</li>
                            <li>Jika mengubah NISN/NIK, pastikan valid</li>
                        </ul>
                    </div>

                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i>
                        <strong>Tips:</strong>
                        <ul class="mb-0 mt-2">
                            <li>Untuk keamanan, rutin ganti password</li>
                            <li>Gunakan password yang kuat (huruf besar, kecil, angka)</li>
                            <li>Jangan berikan password kepada siapapun</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Preview foto
    document.getElementById('foto').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('preview');
        const container = document.getElementById('preview-container');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                container.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });

    // Validasi NISN (hanya angka)
    document.querySelector('input[name="nisn"]').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);
    });

    // Validasi NIK (hanya angka)
    document.querySelector('input[name="nik"]').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16);
    });

    // Validasi No HP (hanya angka)
    document.querySelector('input[name="no_hp_ortu"]').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);
    });
</script>
@endpush
@endsection
