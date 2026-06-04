@extends('admin.layouts.app')

@section('title', 'Detail Pendaftaran')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pendaftaran</h1>
        <div>
            <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-sm btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <a href="{{ route('admin.pendaftaran.edit', $pendaftaran->id) }}" class="btn btn-sm btn-primary">
                <i class="bi bi-pencil"></i> Edit
            </a>
        </div>
    </div>

    <!-- Info Pendaftaran -->
    <div class="row">
        <div class="col-md-8">
            <!-- Status Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h6 class="text-white-50">No. Pendaftaran</h6>
                            <h5 class="mb-0">{{ $pendaftaran->no_pendaftaran }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h6 class="text-white-50">Tanggal Daftar</h6>
                            <h5 class="mb-0">{{ $pendaftaran->created_at->format('d F Y') }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="background-color: #6c757d; color: white;">
                        <div class="card-body">
                            <h6 class="text-white-50">Status</h6>
                            @if($pendaftaran->status_pendaftaran == 'menunggu')
                                <h5 class="mb-0 text-warning">Menunggu</h5>
                            @elseif($pendaftaran->status_pendaftaran == 'diproses')
                                <h5 class="mb-0 text-info">Diproses</h5>
                            @elseif($pendaftaran->status_pendaftaran == 'diterima')
                                <h5 class="mb-0 text-success">Diterima</h5>
                            @else
                                <h5 class="mb-0 text-danger">Ditolak</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Siswa -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pribadi Siswa</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Nama Lengkap</label>
                            <p>{{ $pendaftaran->siswa->nama_lengkap ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">NISN</label>
                            <p>{{ $pendaftaran->siswa->nisn ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">NIK</label>
                            <p>{{ $pendaftaran->siswa->nik ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Tempat, Tanggal Lahir</label>
                            <p>{{ $pendaftaran->siswa->tempat_lahir ?? '-' }}, {{ $pendaftaran->siswa->tanggal_lahir ? $pendaftaran->siswa->tanggal_lahir->format('d F Y') : '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Jenis Kelamin</label>
                            <p>{{ $pendaftaran->siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Agama</label>
                            <p>{{ $pendaftaran->siswa->agama ?? '-' }}</p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="fw-bold">Alamat</label>
                            <p>{{ $pendaftaran->siswa->alamat ?? '-' }}, {{ $pendaftaran->siswa->kelurahan_desa ?? '-' }}, {{ $pendaftaran->siswa->kecamatan ?? '-' }}, {{ $pendaftaran->siswa->kabupaten_kota ?? '-' }}, {{ $pendaftaran->siswa->provinsi ?? '-' }} {{ $pendaftaran->siswa->kode_pos ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Handphone</label>
                            <p>{{ $pendaftaran->siswa->handphone ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Email</label>
                            <p>{{ $pendaftaran->siswa->email ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Asal Sekolah</label>
                            <p>{{ $pendaftaran->siswa->asal_sekolah ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Tahun Lulus</label>
                            <p>{{ $pendaftaran->siswa->tahun_lulus ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Pendaftaran -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pendaftaran</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="fw-bold">Jalur Pendaftaran</label>
                            <p>{{ ucfirst($pendaftaran->jalur_pendaftaran) }}</p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="fw-bold">Jurusan Pilihan 1</label>
                            <p>{{ $pendaftaran->jurusan1 }}</p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="fw-bold">Jurusan Pilihan 2</label>
                            <p>{{ $pendaftaran->jurusan2 ?? '-' }}</p>
                        </div>
                        @if($pendaftaran->jurusan_diterima)
                        <div class="col-md-4 mb-3">
                            <label class="fw-bold">Jurusan Diterima</label>
                            <p><span class="badge bg-success">{{ $pendaftaran->jurusan_diterima }}</span></p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Data Orang Tua -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Orang Tua/Wali</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="fw-bold text-primary">Data Ayah</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td width="150">Nama</td>
                                    <td>: {{ $pendaftaran->nama_ayah }}</td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>: {{ $pendaftaran->nik_ayah ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Pekerjaan</td>
                                    <td>: {{ $pendaftaran->pekerjaan_ayah ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Pendidikan</td>
                                    <td>: {{ $pendaftaran->pendidikan_ayah ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Penghasilan</td>
                                    <td>: {{ $pendaftaran->penghasilan_ayah ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td>: {{ $pendaftaran->telepon_ayah ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold text-primary">Data Ibu</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td width="150">Nama</td>
                                    <td>: {{ $pendaftaran->nama_ibu }}</td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>: {{ $pendaftaran->nik_ibu ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Pekerjaan</td>
                                    <td>: {{ $pendaftaran->pekerjaan_ibu ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Pendidikan</td>
                                    <td>: {{ $pendaftaran->pendidikan_ibu ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Penghasilan</td>
                                    <td>: {{ $pendaftaran->penghasilan_ibu ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td>: {{ $pendaftaran->telepon_ibu ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        @if($pendaftaran->nama_wali)
                        <div class="col-md-12 mt-3">
                            <h6 class="fw-bold text-primary">Data Wali</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td width="150">Nama</td>
                                    <td>: {{ $pendaftaran->nama_wali }}</td>
                                </tr>
                                <tr>
                                    <td>Pekerjaan</td>
                                    <td>: {{ $pendaftaran->pekerjaan_wali ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td>: {{ $pendaftaran->telepon_wali ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Berkas Persyaratan -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Berkas Persyaratan</h6>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="bi bi-file-pdf text-danger me-2"></i>
                                Ijazah
                            </div>
                            @if($pendaftaran->file_ijazah)
                                <a href="{{ Storage::url($pendaftaran->file_ijazah) }}" target="_blank" class="btn btn-sm btn-success">
                                    <i class="bi bi-download"></i>
                                </a>
                            @else
                                <span class="badge bg-danger">Belum</span>
                            @endif
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="bi bi-file-pdf text-danger me-2"></i>
                                Kartu Keluarga
                            </div>
                            @if($pendaftaran->file_kk)
                                <a href="{{ Storage::url($pendaftaran->file_kk) }}" target="_blank" class="btn btn-sm btn-success">
                                    <i class="bi bi-download"></i>
                                </a>
                            @else
                                <span class="badge bg-danger">Belum</span>
                            @endif
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="bi bi-file-pdf text-danger me-2"></i>
                                Akta Kelahiran
                            </div>
                            @if($pendaftaran->file_akte)
                                <a href="{{ Storage::url($pendaftaran->file_akte) }}" target="_blank" class="btn btn-sm btn-success">
                                    <i class="bi bi-download"></i>
                                </a>
                            @else
                                <span class="badge bg-danger">Belum</span>
                            @endif
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="bi bi-image text-info me-2"></i>
                                Pas Foto
                            </div>
                            @if($pendaftaran->file_foto)
                                <a href="{{ Storage::url($pendaftaran->file_foto) }}" target="_blank" class="btn btn-sm btn-success">
                                    <i class="bi bi-eye"></i>
                                </a>
                            @else
                                <span class="badge bg-danger">Belum</span>
                            @endif
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="bi bi-file-pdf text-danger me-2"></i>
                                SKHU
                            </div>
                            @if($pendaftaran->file_skhu)
                                <a href="{{ Storage::url($pendaftaran->file_skhu) }}" target="_blank" class="btn btn-sm btn-success">
                                    <i class="bi bi-download"></i>
                                </a>
                            @else
                                <span class="badge bg-secondary">Opsional</span>
                            @endif
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="bi bi-trophy text-warning me-2"></i>
                                Sertifikat Prestasi
                            </div>
                            @if($pendaftaran->file_prestasi)
                                <a href="{{ Storage::url($pendaftaran->file_prestasi) }}" target="_blank" class="btn btn-sm btn-success">
                                    <i class="bi bi-download"></i>
                                </a>
                            @else
                                <span class="badge bg-secondary">Opsional</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Verifikasi Berkas -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Verifikasi Berkas</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pendaftaran.verifikasi', $pendaftaran->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Status Berkas</label>
                            <select name="status_berkas" class="form-select" required>
                                <option value="pending" {{ $pendaftaran->status_berkas == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="diverifikasi" {{ $pendaftaran->status_berkas == 'diverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                                <option value="ditolak" {{ $pendaftaran->status_berkas == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Catatan</label>
                            <textarea name="catatan" class="form-control" rows="3">{{ $pendaftaran->catatan }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-check-circle"></i> Simpan Verifikasi
                        </button>
                    </form>
                </div>
            </div>

            <!-- Penentuan Kelulusan -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Penentuan Kelulusan</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pendaftaran.kelulusan', $pendaftaran->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Status Kelulusan</label>
                            <select name="status_pendaftaran" class="form-select" required>
                                <option value="menunggu" {{ $pendaftaran->status_pendaftaran == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="diproses" {{ $pendaftaran->status_pendaftaran == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="diterima" {{ $pendaftaran->status_pendaftaran == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="ditolak" {{ $pendaftaran->status_pendaftaran == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                        <div class="mb-3" id="jurusanDiterimaField">
                            <label class="form-label">Jurusan Diterima</label>
                            <select name="jurusan_diterima" class="form-select">
                                <option value="">Pilih Jurusan</option>
                                <option value="IPA" {{ $pendaftaran->jurusan_diterima == 'IPA' ? 'selected' : '' }}>IPA</option>
                                <option value="IPS" {{ $pendaftaran->jurusan_diterima == 'IPS' ? 'selected' : '' }}>IPS</option>
                                <option value="BAHASA" {{ $pendaftaran->jurusan_diterima == 'BAHASA' ? 'selected' : '' }}>Bahasa</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-trophy"></i> Update Kelulusan
                        </button>
                    </form>
                </div>
            </div>

            <!-- Info Verifikasi -->
            @if($pendaftaran->verifikator)
            <div class="card shadow mb-4">
                <div class="card-body">
                    <small class="text-muted">
                        <i class="bi bi-info-circle"></i>
                        Diverifikasi oleh: {{ $pendaftaran->verifikator->name }}<br>
                        Pada: {{ $pendaftaran->tanggal_verifikasi ? $pendaftaran->tanggal_verifikasi->format('d F Y H:i') : '-' }}
                    </small>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusSelect = document.querySelector('select[name="status_pendaftaran"]');
    const jurusanField = document.getElementById('jurusanDiterimaField');

    function toggleJurusanField() {
        if (statusSelect.value === 'diterima') {
            jurusanField.style.display = 'block';
            document.querySelector('select[name="jurusan_diterima"]').setAttribute('required', 'required');
        } else {
            jurusanField.style.display = 'none';
            document.querySelector('select[name="jurusan_diterima"]').removeAttribute('required');
        }
    }

    statusSelect.addEventListener('change', toggleJurusanField);
    toggleJurusanField();
});
</script>
@endpush
@endsection
