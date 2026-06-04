<?php $__env->startSection('title', 'Kelola Informasi PPDB - PPDB'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark">Kelola Informasi PPDB</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active">Informasi PPDB</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="<?php echo e(route('admin.informasi.create')); ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Informasi
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0">Daftar Informasi PPDB</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Utama</th>
                                    <th>Sub Judul</th>
                                    <th>Jadwal</th>
                                    <th>Persyaratan</th>
                                    <th>Kontak</th>
                                    <th>Status</th>
                                    <th>Tampilkan Di</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $informasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $informasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    // Parse JSON data dari konten
                                    $dataInformasi = json_decode($informasi->konten, true);
                                    $judulUtama = $dataInformasi['judul'] ?? $informasi->judul;
                                    $subJudul = $dataInformasi['sub_judul'] ?? '';
                                    $jadwal = $dataInformasi['jadwal'] ?? [];
                                    $persyaratan = $dataInformasi['persyaratan'] ?? [];
                                    $kontak = $dataInformasi['kontak'] ?? [];
                                    $status = $dataInformasi['status'] ?? $informasi->status;
                                    $tampilkanDi = $dataInformasi['tampilkan_di'] ?? 'semua';
                                    
                                    // Hitung jumlah data
                                    $jadwalCount = is_array($jadwal) ? count(array_filter($jadwal, fn($item) => !empty($item['kegiatan']))) : 0;
                                    $persyaratanCount = is_array($persyaratan) ? count(array_filter($persyaratan, fn($item) => !empty($item['nama']))) : 0;
                                    $kontakCount = is_array($kontak) ? count(array_filter($kontak, fn($item) => !empty($item['nilai']))) : 0;
                                ?>
                                <tr>
                                    <td><?php echo e(($informasis->currentPage() - 1) * $informasis->perPage() + $index + 1); ?></td>
                                    <td>
                                        <strong><?php echo e($judulUtama); ?></strong>
                                        <br>
                                        <small class="text-muted"><?php echo e(Str::limit($judulUtama, 50)); ?></small>
                                    </td>
                                    <td><?php echo e($subJudul ?: '-'); ?></td>
                                    <td>
                                        <span class="badge bg-info"><?php echo e($jadwalCount); ?> Jadwal</span>
                                        <?php if($jadwalCount > 0 && $jadwal): ?>
                                            <div class="mt-1">
                                                <?php $__currentLoopData = array_slice($jadwal, 0, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(!empty($item['kegiatan'])): ?>
                                                        <small class="d-block text-muted"><?php echo e($item['kegiatan']); ?>: <?php echo e($item['tanggal']); ?></small>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($jadwalCount > 2): ?>
                                                    <small class="text-muted">... dan <?php echo e($jadwalCount - 2); ?> lainnya</small>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning"><?php echo e($persyaratanCount); ?> Persyaratan</span>
                                        <?php if($persyaratanCount > 0 && $persyaratan): ?>
                                            <div class="mt-1">
                                                <?php $__currentLoopData = array_slice($persyaratan, 0, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(!empty($item['nama'])): ?>
                                                        <small class="d-block text-muted"><?php echo e($item['nama']); ?></small>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($persyaratanCount > 2): ?>
                                                    <small class="text-muted">... dan <?php echo e($persyaratanCount - 2); ?> lainnya</small>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-success"><?php echo e($kontakCount); ?> Kontak</span>
                                        <?php if($kontakCount > 0 && $kontak): ?>
                                            <div class="mt-1">
                                                <?php $__currentLoopData = array_slice($kontak, 0, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(!empty($item['nilai'])): ?>
                                                        <small class="d-block text-muted"><?php echo e(ucfirst($item['tipe'])); ?>: <?php echo e($item['nilai']); ?></small>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($kontakCount > 2): ?>
                                                    <small class="text-muted">... dan <?php echo e($kontakCount - 2); ?> lainnya</small>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge <?php echo e($status == 'aktif' ? 'bg-success' : 'bg-secondary'); ?>">
                                            <?php echo e($status == 'aktif' ? 'Aktif' : 'Nonaktif'); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge <?php echo e($tampilkanDi == 'semua' ? 'bg-primary' : ($tampilkanDi == 'beranda' ? 'bg-info' : 'bg-secondary')); ?>">
                                            <?php echo e(ucfirst($tampilkanDi)); ?>

                                        </span>
                                    </td>
                                    <td><?php echo e($informasi->created_at->format('d/m/Y H:i')); ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?php echo e(route('admin.informasi.edit', $informasi->id)); ?>" class="btn btn-sm btn-warning text-white" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="<?php echo e(route('admin.informasi.show', $informasi->id)); ?>" class="btn btn-sm btn-info text-white" title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <form action="<?php echo e(route('admin.informasi.destroy', $informasi->id)); ?>" method="POST" style="display: inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-danger text-white" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus informasi PPDB ini? Semua data jadwal, persyaratan, dan kontak akan ikut terhapus.')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="10" class="text-center py-4">
                                        <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                                        <p class="text-muted">Belum ada informasi PPDB</p>
                                        <p class="text-muted small">Klik tombol "Tambah Informasi" untuk membuat informasi PPDB baru dengan jadwal, persyaratan, dan kontak.</p>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <?php if($informasis->hasPages()): ?>
                    <div class="d-flex justify-content-center mt-4">
                        <?php echo e($informasis->links()); ?>

                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XAMPP\htdocs\PA3\sistem_informasi_psb\sistem_informasi_psb\resources\views/admin/informasi/index.blade.php ENDPATH**/ ?>