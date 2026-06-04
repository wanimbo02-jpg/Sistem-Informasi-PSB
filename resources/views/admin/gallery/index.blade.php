@extends('admin.layouts.app')

@section('title', 'Gallery - Admin')

@section('content')
<div class="container-fluid px-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Manajemen Gallery</h4>
            <p class="text-muted mb-0 small">Kelola foto dan dokumentasi kegiatan sekolah</p>
        </div>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary px-4">
            <i class="fas fa-plus me-2"></i>Tambah Gallery
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Tabel --}}
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #1e293b; color: white;">
                        <tr>
                            <th class="ps-4 py-3" style="width: 50px;">No</th>
                            <th class="py-3" style="width: 90px;">Gambar</th>
                            <th class="py-3">Judul</th>
                            <th class="py-3" style="width: 120px;">Kategori</th>
                            <th class="py-3" style="width: 130px;">Tanggal</th>
                            <th class="py-3" style="width: 150px;">Lokasi</th>
                            <th class="py-3 text-center" style="width: 90px;">Status</th>
                            <th class="py-3 text-center" style="width: 80px;">Dilihat</th>
                            <th class="py-3 text-center" style="width: 130px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($galleries as $index => $gallery)
                            <tr>
                                <td class="ps-4 text-muted">{{ $galleries->firstItem() + $index }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $gallery->image) }}"
                                         alt="{{ $gallery->title }}"
                                         class="rounded-2"
                                         style="width: 72px; height: 54px; object-fit: cover; transition: transform 0.2s;"
                                         onmouseover="this.style.transform='scale(1.08)'"
                                         onmouseout="this.style.transform='scale(1)'">
                                </td>
                                <td>
                                    <span class="fw-semibold d-block">{{ $gallery->title }}</span>
                                    <small class="text-muted">{{ Str::limit($gallery->description, 55) }}</small>
                                </td>
                                <td>
                                    <span class="badge rounded-pill bg-info text-white px-3 py-2">
                                        {{ $gallery->event_category }}
                                    </span>
                                </td>
                                <td class="text-muted small">{{ $gallery->formatted_date }}</td>
                                <td class="text-muted small">{{ $gallery->location ?? '-' }}</td>
                                <td class="text-center">
                                    @if($gallery->is_active)
                                        <span class="badge rounded-pill bg-success px-3 py-2">Aktif</span>
                                    @else
                                        <span class="badge rounded-pill bg-secondary px-3 py-2">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="text-center text-muted small">
                                    <i class="fas fa-eye me-1"></i>{{ $gallery->views }}
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle-no-arrow"
                                                type="button"
                                                data-bs-toggle="dropdown"
                                                aria-expanded="false"
                                                style="width:36px; height:36px; border-radius:8px; padding:0; background:#6c757d; border:none; color:white; font-size:16px; letter-spacing:1px;">
                                            &#8942;
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.gallery.show', $gallery->id) }}">
                                                    <i class="fas fa-eye me-2 text-info"></i>Detail
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.gallery.edit', $gallery->id) }}">
                                                    <i class="fas fa-edit me-2 text-warning"></i>Edit
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.gallery.destroy', $gallery->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Yakin ingin menghapus gallery ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="fas fa-trash me-2"></i>Hapus
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5">
                                    <i class="fas fa-images fa-3x text-muted mb-3 d-block"></i>
                                    <p class="text-muted mb-3">Belum ada data gallery</p>
                                    <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i>Tambah Gallery Pertama
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Footer pagination --}}
        @if($galleries->total() > 0)
        <div class="card-footer bg-white border-top d-flex justify-content-between align-items-center px-4 py-3">
            <small class="text-muted">
                Menampilkan {{ $galleries->firstItem() }} - {{ $galleries->lastItem() }} dari {{ $galleries->total() }} data
            </small>
            {{ $galleries->links() }}
        </div>
        @endif
    </div>

</div>
@endsection

@push('styles')
<style>
    .table > tbody > tr:hover {
        background-color: #f8fafc;
    }
    .table thead th {
        font-size: 0.82rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }
    .btn-info    { background-color: #0dcaf0; border-color: #0dcaf0; }
    .btn-warning { background-color: #ffc107; border-color: #ffc107; }
    .btn-danger  { background-color: #dc3545; border-color: #dc3545; }
    .btn-sm { padding: 6px 10px; font-size: 13px; border-radius: 6px; }

    /* Fix dropdown terpotong oleh overflow tabel */
    .table-responsive {
        overflow: visible !important;
    }
    .card.border-0.shadow-sm.rounded-3 {
        overflow: visible !important;
    }
    .dropdown-menu {
        position: fixed !important;
        z-index: 9999 !important;
        min-width: 150px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15) !important;
        border-radius: 10px !important;
        border: 1px solid #e2e8f0 !important;
    }
    .dropdown-item {
        padding: 8px 16px;
        font-size: 0.9rem;
    }
    .dropdown-item:hover {
        background-color: #f1f5f9;
    }
</style>
@endpush

@push('scripts')
<script>
    setTimeout(function() {
        document.querySelectorAll('.alert').forEach(el => {
            el.classList.remove('show');
        });
    }, 5000);

    // Fix dropdown posisi agar tidak terpotong tabel
    document.querySelectorAll('.dropdown').forEach(function(dropdown) {
        dropdown.addEventListener('show.bs.dropdown', function(e) {
            const btn = this.querySelector('[data-bs-toggle="dropdown"]');
            const menu = this.querySelector('.dropdown-menu');
            const rect = btn.getBoundingClientRect();
            menu.style.top  = (rect.bottom + window.scrollY + 4) + 'px';
            menu.style.left = (rect.right - 150 + window.scrollX) + 'px';
        });
    });
</script>
@endpush
