@extends('admin.layouts.app')

@section('title', 'Data Fasilitas - Admin')

@section('content')
<div class="container-fluid px-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1"><i class="bi bi-building text-primary me-2"></i>Data Fasilitas</h4>
            <p class="text-muted mb-0 small">Kelola fasilitas sekolah yang tampil di halaman publik</p>
        </div>
        <a href="{{ route('admin.fasilitas.create') }}" class="btn btn-primary px-4">
            <i class="bi bi-plus-circle me-2"></i>Tambah Fasilitas
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm" style="border-radius: 14px; overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #1e293b; color: white;">
                        <tr>
                            <th class="ps-4 py-3" style="width:50px;">No</th>
                            <th class="py-3" style="width:100px;">Gambar</th>
                            <th class="py-3">Nama Fasilitas</th>
                            <th class="py-3">Deskripsi</th>
                            <th class="py-3 text-center" style="width:90px;">Status</th>
                            <th class="py-3 text-center" style="width:110px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($fasilitas as $i => $item)
                        <tr>
                            <td class="ps-4 text-muted">{{ $fasilitas->firstItem() + $i }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $item->gambar) }}"
                                     alt="{{ $item->nama }}"
                                     class="rounded-2"
                                     style="width:80px; height:60px; object-fit:cover;">
                            </td>
                            <td class="fw-semibold">{{ $item->nama }}</td>
                            <td class="text-muted small">{{ Str::limit($item->deskripsi, 80) }}</td>
                            <td class="text-center">
                                @if($item->is_active)
                                    <span class="badge rounded-pill bg-success px-3 py-2">Aktif</span>
                                @else
                                    <span class="badge rounded-pill bg-secondary px-3 py-2">Nonaktif</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-secondary"
                                            type="button" data-bs-toggle="dropdown"
                                            style="width:36px;height:36px;border-radius:8px;padding:0;font-size:16px;">
                                        &#8942;
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.fasilitas.show', $item->id) }}">
                                                <i class="bi bi-eye me-2 text-info"></i>Detail
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.fasilitas.edit', $item->id) }}">
                                                <i class="bi bi-pencil me-2 text-warning"></i>Edit
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('admin.fasilitas.destroy', $item->id) }}" method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus fasilitas ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="bi bi-trash me-2"></i>Hapus
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-building fs-1 text-muted d-block mb-3"></i>
                                <p class="text-muted mb-3">Belum ada data fasilitas</p>
                                <a href="{{ route('admin.fasilitas.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-2"></i>Tambah Fasilitas Pertama
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($fasilitas->total() > 0)
        <div class="card-footer bg-white border-top d-flex justify-content-between align-items-center px-4 py-3">
            <small class="text-muted">
                Menampilkan {{ $fasilitas->firstItem() }} - {{ $fasilitas->lastItem() }} dari {{ $fasilitas->total() }} data
            </small>
            {{ $fasilitas->links() }}
        </div>
        @endif
    </div>

</div>
@endsection

@push('styles')
<style>
    .table-responsive { overflow: visible !important; }
    .dropdown-menu { position: fixed !important; z-index: 9999 !important; min-width: 140px; border-radius: 10px !important; }
    .table > tbody > tr:hover { background-color: #f8fafc; }
    .table thead th { font-size: 0.82rem; font-weight: 600; letter-spacing: 0.5px; text-transform: uppercase; }
</style>
@endpush

@push('scripts')
<script>
    document.querySelectorAll('.dropdown').forEach(function(dropdown) {
        dropdown.addEventListener('show.bs.dropdown', function() {
            const btn  = this.querySelector('[data-bs-toggle="dropdown"]');
            const menu = this.querySelector('.dropdown-menu');
            const rect = btn.getBoundingClientRect();
            menu.style.top  = (rect.bottom + window.scrollY + 4) + 'px';
            menu.style.left = (rect.right - 140 + window.scrollX) + 'px';
        });
    });
    setTimeout(function() {
        document.querySelectorAll('.alert').forEach(el => el.classList.remove('show'));
    }, 5000);
</script>
@endpush
