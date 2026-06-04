<?php $__env->startSection('title', 'Pengumuman - Guru'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4">

    
    <div class="d-flex align-items-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-0">Pengumuman</h4>
            <p class="text-muted mb-0 small">Kelola pengumuman untuk publik</p>
        </div>
    </div>

    <div class="row g-4">

        
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; overflow: hidden;">
                <div class="card-header border-0 py-3 px-4" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                    <div class="d-flex align-items-center justify-content-between text-white">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-funnel-fill fs-5"></i>
                            <span class="fw-bold">Hasil Seleksi Administrasi</span>
                        </div>
                        <?php if($pengumumanSeleksi): ?>
                            <a href="<?php echo e(route('guru.pengumuman.edit', $pengumumanSeleksi->id)); ?>" class="btn btn-light btn-sm px-3">
                                <i class="bi bi-pencil me-1"></i>Edit
                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(route('guru.pengumuman.create', ['jenis' => 'seleksi_administrasi'])); ?>" class="btn btn-light btn-sm px-3">
                                <i class="bi bi-plus-lg me-1"></i>Tambah
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body p-4">
                    <?php if($pengumumanSeleksi): ?>
                        <div class="alert alert-info mb-0">
                            <div class="d-flex align-items-start gap-3">
                                <i class="bi bi-info-circle-fill fs-4"></i>
                                <div>
                                    <h5 class="alert-heading fw-bold mb-1"><?php echo e($pengumumanSeleksi->judul); ?></h5>
                                    <?php if($pengumumanSeleksi->sub_judul): ?>
                                        <p class="mb-2 text-muted"><?php echo e($pengumumanSeleksi->sub_judul); ?></p>
                                    <?php endif; ?>
                                    <?php if($pengumumanSeleksi->tahun_ajaran): ?>
                                        <p class="mb-2"><strong>Tahun Ajaran:</strong> <?php echo e($pengumumanSeleksi->tahun_ajaran); ?></p>
                                    <?php endif; ?>
                                    <?php if($pengumumanSeleksi->file): ?>
                                        <p class="mb-0">
                                            <strong>File:</strong>
                                            <a href="<?php echo e(asset('storage/'.$pengumumanSeleksi->file)); ?>" target="_blank" class="ms-2">
                                                <i class="bi bi-download"></i> Download File
                                            </a>
                                        </p>
                                    <?php endif; ?>
                                    <div class="mt-2">
                                        <span class="badge <?php echo e($pengumumanSeleksi->aktif ? 'bg-success' : 'bg-secondary'); ?>">
                                            <?php echo e($pengumumanSeleksi->aktif ? 'Aktif' : 'Tidak Aktif'); ?>

                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="bi bi-funnel" style="font-size:3rem;color:#ccc;"></i>
                            <p class="text-muted mt-3 mb-2">Belum ada pengumuman seleksi administrasi.</p>
                            <a href="<?php echo e(route('guru.pengumuman.create', ['jenis' => 'seleksi_administrasi'])); ?>" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-lg me-2"></i>Tambah
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; overflow: hidden;">
                <div class="card-header border-0 py-3 px-4" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                    <div class="d-flex align-items-center justify-content-between text-white">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-trophy-fill fs-5"></i>
                            <span class="fw-bold">Hasil Pengumuman Final</span>
                        </div>
                        <?php if($pengumumanFinal): ?>
                            <a href="<?php echo e(route('guru.pengumuman.edit', $pengumumanFinal->id)); ?>" class="btn btn-light btn-sm px-3">
                                <i class="bi bi-pencil me-1"></i>Edit
                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(route('guru.pengumuman.create', ['jenis' => 'pengumuman_final'])); ?>" class="btn btn-light btn-sm px-3">
                                <i class="bi bi-plus-lg me-1"></i>Tambah
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body p-4">
                    <?php if($pengumumanFinal): ?>
                        <div class="alert alert-info mb-0">
                            <div class="d-flex align-items-start gap-3">
                                <i class="bi bi-info-circle-fill fs-4"></i>
                                <div>
                                    <h5 class="alert-heading fw-bold mb-1"><?php echo e($pengumumanFinal->judul); ?></h5>
                                    <?php if($pengumumanFinal->sub_judul): ?>
                                        <p class="mb-2 text-muted"><?php echo e($pengumumanFinal->sub_judul); ?></p>
                                    <?php endif; ?>
                                    <?php if($pengumumanFinal->tahun_ajaran): ?>
                                        <p class="mb-2"><strong>Tahun Ajaran:</strong> <?php echo e($pengumumanFinal->tahun_ajaran); ?></p>
                                    <?php endif; ?>
                                    <?php if($pengumumanFinal->file): ?>
                                        <p class="mb-0">
                                            <strong>File:</strong>
                                            <a href="<?php echo e(asset('storage/'.$pengumumanFinal->file)); ?>" target="_blank" class="ms-2">
                                                <i class="bi bi-download"></i> Download File
                                            </a>
                                        </p>
                                    <?php endif; ?>
                                    <div class="mt-2">
                                        <span class="badge <?php echo e($pengumumanFinal->aktif ? 'bg-success' : 'bg-secondary'); ?>">
                                            <?php echo e($pengumumanFinal->aktif ? 'Aktif' : 'Tidak Aktif'); ?>

                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="bi bi-trophy" style="font-size:3rem;color:#ccc;"></i>
                            <p class="text-muted mt-3 mb-2">Belum ada pengumuman final.</p>
                            <a href="<?php echo e(route('guru.pengumuman.create', ['jenis' => 'pengumuman_final'])); ?>" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-lg me-2"></i>Tambah
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('guru.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XAMPP\htdocs\PA3\sistem_informasi_psb\sistem_informasi_psb\resources\views/guru/pengumuman/index.blade.php ENDPATH**/ ?>