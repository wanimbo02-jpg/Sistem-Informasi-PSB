@extends('siswa.layouts.app')

@section('title', 'Profile Saya')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profile Saya</h1>
        <div>
            <a href="{{ route('siswa.profile.edit') }}" class="btn btn-sm btn-warning">
                <i class="bi bi-pencil-square"></i> Edit Profile
            </a>
            <a href="{{ route('siswa.dashboard') }}" class="btn btn-sm btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(!$siswa)
    <div class="alert alert-warning">
        <i class="bi bi-exclamation-triangle"></i>
        Anda belum melengkapi data profile. Silakan <a href="{{ route('siswa.profile.create') }}" class="alert-link">buat profile sekarang</a>.
    </div>
    @endif

    <div class="row">
        <!-- Profile Card -->
        <div class="col-xl-4 col-md-5 mb-4">
            <div class="card shadow h-100">
                <div class="card-header bg-info text-white">
                    <h6 class="m-0 font-weight-bold">Foto Profile</h6>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        @if($user->foto)
                            <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto Profile"
                                 class="img-fluid rounded-circle border" style="width: 200px; height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-secondary bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                 style="width: 200px; height: 200px;">
                                <i class="bi bi-person-circle fs-1 text-secondary"></i>
                            </div>
                        @endif
                    </div>

                    <h4 class="mb-1">{{ $user->name }}</h4>
                    <p class="text-muted">{{ $user->email }}</p>

                    <hr>

                    <div class="text-start">
                        <p class="mb-2">
                            <i class="bi bi-telephone text-info me-2"></i>
                            <strong>No. HP:</strong> {{ $user->no_hp ?? '-' }}
                        </p>
                        <p class="mb-2">
                            <i class="bi bi-geo-alt text-info me-2"></i>
                            <strong>Alamat:</strong> {{ $user->alamat ?? '-' }}
                        </p>
                        <p class="mb-2">
                            <i class="bi bi-calendar text-info me-2"></i>
                            <strong>Bergabung:</strong> {{ $user->created_at->format('d F Y') }}
                        </p>
                    </div>

                    <hr>

                    <div class="d-grid gap-2">
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#fotoModal">
                            <i class="bi bi-camera"></i> Ganti Foto
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Siswa -->
        <div class="col-xl-8 col-md-7 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header bg-info text-white">
                    <h6 class="m-0 font-weight-bold">Data Diri Siswa</h6>
                </div>
                <div class="card-body">
                    @if($siswa)
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="120">NISN</td>
                                    <td width="10">:</td>
                                    <td><strong>{{ $siswa->nisn }}</strong></td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>:</td>
                                    <td><strong>{{ $siswa->nik }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Tempat Lahir</td>
                                    <td>:</td>
                                    <td>{{ $siswa->tempat_lahir }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Lahir</td>
                                    <td>:</td>
                                    <td>{{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Usia</td>
                                    <td>:</td>
                                    <td>{{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->age }} tahun</td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>:</td>
                                    <td>{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                </tr>
                                <tr>
                                    <td>Agama</td>
                                    <td>:</td>
                                    <td>{{ $siswa->agama }}</td>
                                </tr>
                                <tr>
                                    <td>Asal Sekolah</td>
                                    <td>:</td>
                                    <td>{{ $siswa->asal_sekolah }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="120">Nama Ayah</td>
                                    <td width="10">:</td>
                                    <td>{{ $siswa->nama_ayah }}</td>
                                </tr>
                                <tr>
                                    <td>Pekerjaan Ayah</td>
                                    <td>:</td>
                                    <td>{{ $siswa->pekerjaan_ayah ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Ibu</td>
                                    <td>:</td>
                                    <td>{{ $siswa->nama_ibu }}</td>
                                </tr>
                                <tr>
                                    <td>Pekerjaan Ibu</td>
                                    <td>:</td>
                                    <td>{{ $siswa->pekerjaan_ibu ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>No. HP Orang Tua</td>
                                    <td>:</td>
                                    <td>{{ $siswa->no_hp_ortu }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat Orang Tua</td>
                                    <td>:</td>
                                    <td>{{ $siswa->alamat_ortu }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('siswa.profile.edit') }}" class="btn btn-warning me-2">
                            <i class="bi bi-pencil-square"></i> Edit Data
                        </a>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal">
                            <i class="bi bi-trash"></i> Hapus Profile
                        </button>
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="bi bi-person-x fs-1 text-muted d-block mb-3"></i>
                        <h5>Belum Ada Data Profile</h5>
                        <p class="text-muted">Silakan lengkapi data profile Anda untuk dapat mendaftar.</p>
                        <a href="{{ route('siswa.profile.create') }}" class="btn btn-info">
                            <i class="bi bi-plus-circle"></i> Buat Profile Sekarang
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ganti Foto -->
<div class="modal fade" id="fotoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('siswa.profile.update-foto') }}" method="POST" enctype="multipart/form-data" id="formFoto">
                @csrf
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">Ganti Foto Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <img id="preview-foto" src="{{ $user->foto ? asset('storage/'.$user->foto) : 'https://via.placeholder.com/200' }}"
                             class="img-fluid rounded-circle border" style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pilih Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control" accept="image/*" required>
                        <small class="text-muted">Format: JPG/PNG, Maks: 2MB</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info" id="btnSimpanFoto">
                        <i class="bi bi-upload"></i> Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus Profile -->
@if($siswa)
<div class="modal fade" id="hapusModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('siswa.profile.destroy') }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Hapus Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle"></i>
                        <strong>Perhatian!</strong> Menghapus profile akan menghapus semua data diri Anda. Tindakan ini tidak dapat dibatalkan.
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Masukkan Password untuk Konfirmasi</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Hapus Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@push('scripts')
<script>
    // Preview foto sebelum upload
    document.addEventListener('DOMContentLoaded', function() {
        const fotoInput = document.getElementById('foto');
        if (fotoInput) {
            fotoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('preview-foto').src = e.target.result;
                }

                if (file) {
                    reader.readAsDataURL(file);
                }
            });
        }

        // Upload foto dengan AJAX
        const formFoto = document.getElementById('formFoto');
        if (formFoto) {
            formFoto.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const btn = document.getElementById('btnSimpanFoto');

                btn.disabled = true;
                btn.innerHTML = '<i class="bi bi-hourglass"></i> Mengupload...';

                fetch('{{ route("siswa.profile.update-foto") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Foto berhasil diupload!');
                        location.reload();
                    } else {
                        let errorMessage = 'Gagal upload foto';
                        if (data.errors) {
                            errorMessage = Object.values(data.errors).flat().join('\n');
                        } else if (data.message) {
                            errorMessage = data.message;
                        }
                        alert(errorMessage);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat upload. Silakan coba lagi.');
                })
                .finally(() => {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="bi bi-upload"></i> Upload';
                });
            });
        }
    });
</script>
@endpush
@endsection
