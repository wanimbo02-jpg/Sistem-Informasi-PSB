<?php $__env->startSection('title', 'Siswa yang Sudah Diseleksi - PPDB'); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .status-badge {
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
    }
    .status-diterima { background: #d4edda; color: #155724; }
    .status-menunggu { background: #fff3cd; color: #856404; }
    .status-proses { background: #cff4fc; color: #055160; }

    .table {
        margin-bottom: 0;
        border: 2px solid #dee2e6;
        border-collapse: collapse;
    }
    .table thead th {
        background: #f8f9fa;
        color: #333;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: 1px solid #dee2e6;
        padding: 1rem;
        text-align: center;
    }
    .table tbody tr {
        transition: none;
        cursor: pointer;
    }
    .table tbody tr:hover {
        background-color: #f8f9fa;
    }
    .table tbody td {
        vertical-align: middle;
        padding: 0.75rem 1rem;
        border: 1px solid #dee2e6;
        text-align: center;
    }
    .table tbody td:first-child,
    .table tbody td:nth-child(2),
    .table tbody td:nth-child(5),
    .table tbody td:nth-child(6) {
        text-align: left;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-dark">Siswa yang Sudah Diseleksi</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('guru.dashboard')); ?>" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active">Siswa yang Sudah Diseleksi</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex gap-3 align-items-center">
            <div class="input-group" style="width: 250px;">
                <span class="input-group-text bg-white border-end-0">
                    <i class="bi bi-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0" placeholder="Cari siswa..." id="searchInput">
            </div>
            <button type="button" class="btn btn-success" onclick="updateAllToPengumuman()">
                <i class="bi bi-upload"></i> Update ke Pengumuman
            </button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exportModal">
                <i class="bi bi-download"></i> Export Data
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0">Daftar Siswa Diterima</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>NISN</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Asal Sekolah</th>
                                    <th>Tanggal Diterima</th>
                                    <th>Status Seleksi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $siswaDiterima; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $siswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e(($siswaDiterima->currentPage() - 1) * $siswaDiterima->perPage() + $index + 1); ?></td>
                                    <td><?php echo e($siswa->nama_lengkap); ?></td>
                                    <td><?php echo e($siswa->nisn); ?></td>
                                    <td><?php echo e($siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'); ?></td>
                                    <td><?php echo e($siswa->asal_sekolah); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($siswa->tanggal_diterima)->format('d/m/Y')); ?></td>
                                    <td>
                                        <span class="status-badge status-<?php echo e($siswa->status_seleksi); ?>">
                                            <?php echo e(ucfirst($siswa->status_seleksi)); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <form action="<?php echo e(route('guru.siswa-diseleksi.update', $siswa->id)); ?>" method="POST" style="display: inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                <i class="bi bi-arrow-repeat"></i> Update
                                            </button>
                                        </form>
                                        <form action="<?php echo e(route('guru.siswa-diseleksi.destroy', $siswa->id)); ?>" method="POST" style="display: inline; margin-left: 5px;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                                        <p class="text-muted">Belum ada siswa yang diseleksi</p>
                                        <p class="text-muted small">Edit data siswa dan ubah status menjadi "Diterima" untuk menambahkan siswa ke sini.</p>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <?php if($siswaDiterima->hasPages()): ?>
                    <div class="d-flex justify-content-end mt-3">
                        <?php echo e($siswaDiterima->links('pagination::custom')); ?>

                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Fungsi search siswa
document.getElementById('searchInput').addEventListener('keyup', function() {
    var searchValue = this.value.toLowerCase();
    var tableRows = document.querySelectorAll('tbody tr');
    
    tableRows.forEach(function(row) {
        var rowData = row.textContent.toLowerCase();
        
        if (rowData.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

function updateAllToPengumuman() {
    if (confirm('Apakah Anda yakin ingin mengupdate semua data siswa yang diseleksi ke halaman Pengumuman user?')) {
        fetch('<?php echo e(route("guru.siswa-diseleksi.update-all")); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            body: JSON.stringify({
                action: 'update_to_pengumuman'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Data berhasil diupdate ke halaman Pengumuman! Total: ' + data.count + ' siswa\n\nData sekarang dapat dilihat di halaman Pengumuman user.');
            } else {
                alert('Gagal mengupdate data!');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan!');
        });
    }
}
</script>

<!-- Modal Export -->
<div class="modal fade" id="exportModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Export Data Siswa Diseleksi</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Pilih format export:</p>
                <div class="d-grid gap-2">
                    <a href="/guru/siswa-diseleksi/export/excel" class="btn btn-outline-success">
                        <i class="bi bi-file-excel me-2"></i>Export ke Excel
                    </a>
                    <a href="/guru/siswa-diseleksi/export/pdf" class="btn btn-outline-danger">
                        <i class="bi bi-file-pdf me-2"></i>Export ke PDF
                    </a>
                    <a href="/guru/siswa-diseleksi/export/print" class="btn btn-outline-primary" target="_blank">
                        <i class="bi bi-printer me-2"></i>Cetak
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('guru.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XAMPP\htdocs\PA3\sistem_informasi_psb\sistem_informasi_psb\resources\views/guru/siswa-diseleksi/index.blade.php ENDPATH**/ ?>