<?php $__env->startSection('title', 'Informasi Pendaftaran - PPDB'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-dark">Informasi Pendaftaran</h2>
                <p class="text-muted">Dapatkan informasi terbaru seputar pendaftaran siswa baru</p>
            </div>
        </div>
    </div>

    <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $informasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $informasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <?php
                        $dataInformasi = json_decode($informasi->konten, true);
                        $judul = $dataInformasi['judul'] ?? $informasi->judul;
                        $subJudul = $dataInformasi['sub_judul'] ?? '';
                    ?>
                    <h5 class="card-title text-primary"><?php echo e($judul); ?></h5>
                    <?php if($subJudul): ?>
                        <h6 class="text-muted mb-3"><?php echo e($subJudul); ?></h6>
                    <?php endif; ?>
                    <div class="card-text text-muted">
                        <?php if($dataInformasi && isset($dataInformasi['konten'])): ?>
                            <?php echo Str::limit(strip_tags($dataInformasi['konten']), 200); ?>

                        <?php else: ?>
                            <?php echo e(Str::limit($informasi->konten, 150)); ?>

                        <?php endif; ?>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            <i class="bi bi-calendar3"></i> <?php echo e($informasi->created_at->format('d M Y')); ?>

                        </small>
                        <a href="<?php echo e(route('informasi-pendaftaran.show', $informasi->id)); ?>" class="btn btn-sm btn-outline-primary">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12">
            <div class="text-center py-5">
                <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                <h5 class="text-muted">Belum Ada Informasi</h5>
                <p class="text-muted">Belum ada informasi pendaftaran yang tersedia saat ini.</p>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if($informasis->hasPages()): ?>
    <div class="d-flex justify-content-center mt-4">
        <?php echo e($informasis->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public-home', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XAMPP\htdocs\PA3\sistem_informasi_psb\sistem_informasi_psb\resources\views/informasi-pendaftaran/index.blade.php ENDPATH**/ ?>