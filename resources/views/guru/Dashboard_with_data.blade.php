@extends('guru.layouts.app')

@section('title', 'Dashboard Guru')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Guru</h1>
        <a href="#" class="btn btn-sm btn-success shadow-sm">
            <i class="bi bi-plus-circle"></i> Input Nilai
        </a>
    </div>

    <!-- Welcome Message -->
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-info-circle"></i> Selamat datang, Bapak/Ibu Guru. Anda dapat melihat data pendaftaran siswa di bawah ini.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-dashboard border-left-primary h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pendaftar
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people fs-2 text-primary opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-dashboard border-left-warning h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Menunggu Verifikasi
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pending ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-clock fs-2 text-warning opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-dashboard border-left-success h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Diterima
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $accepted ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-check-circle fs-2 text-success opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-dashboard border-left-danger h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Ditolak
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $rejected ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-x-circle fs-2 text-danger opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Pendaftaran Siswa -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Pendaftaran Siswa</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-three-dots-vertical"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in">
                    <a class="dropdown-item" href="#">Export Data</a>
                    <a class="dropdown-item" href="#">Cetak Laporan</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Refresh</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>NIK</th>
                        <th>NISN</th>
                            <th>Email</th>
                            <th>Asal Sekolah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (($pendaftarans ?? []) as $index => $pendaftaran)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $pendaftaran->nama_lengkap ?? '-' }}</td>
                            <td>{{ $pendaftaran->nik ?? '-' }}</td>
                            <td>{{ $pendaftaran->nisn ?? '-' }}</td>
                            <td>{{ $pendaftaran->email ?? ($pendaftaran->user->email ?? '-') }}</td>
                            <td>{{ $pendaftaran->asal_sekolah ?? '-' }}</td>
                            <td>
                                @if($pendaftaran->status == 'pending')
                                    <span class="badge bg-warning">Menunggu</span>
                                @elseif($pendaftaran->status == 'accepted')
                                    <span class="badge bg-success">Diterima</span>
                                @elseif($pendaftaran->status == 'rejected')
                                    <span class="badge bg-danger">Ditolak</span>
                                @else
                                    <span class="badge bg-secondary">Baru</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $pendaftaran->id }}">
                                        <i class="bi bi-eye"></i> Detail
                                    </button>
                                    
                                    @if($pendaftaran->status == 'pending')
                                        <button type="button" class="btn btn-sm btn-success" onclick="updateStatus({{ $pendaftaran->id }}, 'accepted')">
                                            <i class="bi bi-check"></i> Terima
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="updateStatus({{ $pendaftaran->id }}, 'rejected')">
                                            <i class="bi bi-x"></i> Tolak
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Detail -->
                        <div class="modal fade" id="detailModal{{ $pendaftaran->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Pendaftar - {{ $pendaftaran->nama_lengkap }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Data Pribadi</h6>
                                                <table class="table table-sm">
                                                    <tr><td>NIK</td><td>: {{ $pendaftaran->nik ?? '-' }}</td></tr>
                            <tr><td>NISN</td><td>: {{ $pendaftaran->nisn ?? '-' }}</td></tr>
                                                    <tr><td>Tempat Lahir</td><td>: {{ $pendaftaran->tempat_lahir ?? '-' }}</td></tr>
                                                    <tr><td>Tanggal Lahir</td><td>: {{ $pendaftaran->tanggal_lahir ?? '-' }}</td></tr>
                                                    <tr><td>Jenis Kelamin</td><td>: {{ $pendaftaran->jenis_kelamin ?? '-' }}</td></tr>
                                                    <tr><td>Agama</td><td>: {{ $pendaftaran->agama ?? '-' }}</td></tr>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Kontak & Sekolah</h6>
                                                <table class="table table-sm">
                                                    <tr><td>Email</td><td>: {{ $pendaftaran->email ?? ($pendaftaran->user->email ?? '-') }}</td></tr>
                                                    <tr><td>Handphone</td><td>: {{ $pendaftaran->handphone ?? '-' }}</td></tr>
                                                    <tr><td>Asal Sekolah</td><td>: {{ $pendaftaran->asal_sekolah ?? '-' }}</td></tr>
                                                    <tr><td>Tahun Lulus</td><td>: {{ $pendaftaran->tahun_lulus ?? '-' }}</td></tr>
                                                    <tr><td>Status</td><td>: {{ $pendaftaran->status ?? 'Baru' }}</td></tr>
                                                </table>
                                            </div>
                                        </div>
                                        
                                        <h6>Alamat</h6>
                                        <p>{{ $pendaftaran->alamat ?? '-' }}, {{ $pendaftaran->kelurahan_desa ?? '-' }}, {{ $pendaftaran->kecamatan ?? '-' }}, {{ $pendaftaran->kabupaten_kota ?? '-' }}, {{ $pendaftaran->provinsi ?? '-' }} {{ $pendaftaran->kode_pos ?? '-' }}</p>
                                        
                                        <h6>Data Orang Tua</h6>
                                        <table class="table table-sm">
                                            <tr><td>Nama Ayah</td><td>: {{ $pendaftaran->nama_ayah ?? '-' }}</td></tr>
                                            <tr><td>Nama Ibu</td><td>: {{ $pendaftaran->nama_ibu ?? '-' }}</td></tr>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum ada data pendaftaran</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.card-dashboard {
    border-left: 0.25rem solid;
}
</style>
<script>
function updateStatus(id, status) {
    if (confirm('Yakin ingin mengubah status ini?')) {
        fetch('/guru/pendaftaran/' + id + '/status', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                status: status
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload();
            }
        });
    }
}
</script>
@endsection
