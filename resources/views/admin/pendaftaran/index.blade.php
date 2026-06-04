@extends('admin.layouts.app')

@section('title', 'Data Pendaftaran')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pendaftaran Siswa Baru</h1>
        <a href="{{ route('admin.pendaftaran.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="bi bi-plus-circle"></i> Tambah Pendaftaran
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-2 col-md-4 mb-3">
            <div class="card bg-primary text-white h-100">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Total</h6>
                            <h4 class="mb-0">{{ $statistik['total'] }}</h4>
                        </div>
                        <i class="bi bi-people fs-2 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 mb-3">
            <div class="card bg-warning text-white h-100">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Menunggu</h6>
                            <h4 class="mb-0">{{ $statistik['menunggu'] }}</h4>
                        </div>
                        <i class="bi bi-hourglass fs-2 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 mb-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Diproses</h6>
                            <h4 class="mb-0">{{ $statistik['diproses'] }}</h4>
                        </div>
                        <i class="bi bi-gear fs-2 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 mb-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Diterima</h6>
                            <h4 class="mb-0">{{ $statistik['diterima'] }}</h4>
                        </div>
                        <i class="bi bi-check-circle fs-2 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 mb-3">
            <div class="card bg-danger text-white h-100">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Ditolak</h6>
                            <h4 class="mb-0">{{ $statistik['ditolak'] }}</h4>
                        </div>
                        <i class="bi bi-x-circle fs-2 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 mb-3">
            <div class="card bg-secondary text-white h-100">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Verifikasi</h6>
                            <h4 class="mb-0">{{ $statistik['verifikasi_pending'] }}</h4>
                        </div>
                        <i class="bi bi-file-check fs-2 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Data Pendaftaran</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.pendaftaran.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Status Pendaftaran</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Jurusan</label>
                    <select name="jurusan" class="form-select">
                        <option value="">Semua Jurusan</option>
                        <option value="IPA" {{ request('jurusan') == 'IPA' ? 'selected' : '' }}>IPA</option>
                        <option value="IPS" {{ request('jurusan') == 'IPS' ? 'selected' : '' }}>IPS</option>
                        <option value="BAHASA" {{ request('jurusan') == 'BAHASA' ? 'selected' : '' }}>Bahasa</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Pencarian</label>
                    <input type="text" name="search" class="form-control" placeholder="Cari Nama/NISN/No Pendaftaran" value="{{ request('search') }}">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pendaftaran</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>No. Pendaftaran</th>
                            <th>Nama Siswa</th>
                            <th>NISN</th>
                            <th>Jurusan 1</th>
                            <th>Jurusan 2</th>
                            <th>Tanggal Daftar</th>
                            <th>Status Berkas</th>
                            <th>Status</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendaftarans as $index => $p)
                        <tr>
                            <td>{{ $pendaftarans->firstItem() + $index }}</td>
                            <td>
                                <span class="fw-bold">{{ $p->no_pendaftaran }}</span>
                            </td>
                            <td>{{ $p->siswa->nama_lengkap ?? '-' }}</td>
                            <td>{{ $p->siswa->nisn ?? '-' }}</td>
                            <td>{{ $p->jurusan1 }}</td>
                            <td>{{ $p->jurusan2 ?? '-' }}</td>
                            <td>{{ $p->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if($p->status_berkas == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($p->status_berkas == 'diverifikasi')
                                    <span class="badge bg-success">Terverifikasi</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                @if($p->status_pendaftaran == 'menunggu')
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                @elseif($p->status_pendaftaran == 'diproses')
                                    <span class="badge bg-info">Diproses</span>
                                @elseif($p->status_pendaftaran == 'diterima')
                                    <span class="badge bg-success">Diterima</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.pendaftaran.show', $p->id) }}" class="btn btn-sm btn-info" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.pendaftaran.edit', $p->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $p->id }}" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $p->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Yakin ingin menghapus data pendaftaran <strong>{{ $p->no_pendaftaran }}</strong>?</p>
                                        <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan!</small></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <form action="{{ route('admin.pendaftaran.destroy', $p->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center py-4">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Tidak ada data pendaftaran
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    Menampilkan {{ $pendaftarans->firstItem() }} - {{ $pendaftarans->lastItem() }} dari {{ $pendaftarans->total() }} data
                </div>
                <div>
                    {{ $pendaftarans->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
