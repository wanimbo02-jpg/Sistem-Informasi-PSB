<?php $__env->startSection('title', 'Visi & Misi - Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">
                <i class="bi bi-bullseye text-primary me-2"></i>Visi & Misi Sekolah
            </h4>
            <p class="text-muted mb-0 small">Kelola visi dan misi sekolah</p>
        </div>
        <?php if(!$visiMisi): ?>
        <a href="<?php echo e(route('admin.visi-misi.create')); ?>" class="btn btn-primary px-4">
            <i class="bi bi-plus-circle me-2"></i>Tambah
        </a>
        <?php endif; ?>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
            <i class="bi bi-check-circle me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if($visiMisi): ?>

    
    <div class="row g-4 mb-4">

        
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; overflow: hidden;">
                <div class="card-header border-0 py-3 px-4" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                    <div class="d-flex align-items-center gap-2 text-white">
                        <i class="bi bi-eye-fill fs-5"></i>
                        <span class="fw-bold fs-6">Visi Sekolah</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <p class="fst-italic text-secondary lh-lg mb-0" style="font-size: 0.97rem;">
                        "<?php echo e($visiMisi->visi); ?>"
                    </p>
                </div>
            </div>
        </div>

        
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; overflow: hidden;">
                <div class="card-header border-0 py-3 px-4" style="background: linear-gradient(135deg, #198754, #146c43);">
                    <div class="d-flex align-items-center gap-2 text-white">
                        <i class="bi bi-list-check fs-5"></i>
                        <span class="fw-bold fs-6">Misi Sekolah</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <?php $misiList = array_filter(explode("\n", $visiMisi->misi)); ?>
                    <ul class="list-unstyled mb-0">
                        <?php $__currentLoopData = $misiList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(trim($item)): ?>
                            <li class="d-flex align-items-start gap-2 mb-2">
                                <i class="bi bi-check-circle-fill text-success mt-1" style="font-size: 13px; flex-shrink:0;"></i>
                                <span class="text-secondary" style="font-size: 0.95rem;"><?php echo e(trim($item)); ?></span>
                            </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    
    <div class="card border-0 shadow-sm p-3 d-flex flex-row justify-content-end gap-2" style="border-radius: 12px;">
        <a href="<?php echo e(route('admin.visi-misi.edit', $visiMisi->id)); ?>" class="btn btn-warning text-white px-4">
            <i class="bi bi-pencil-fill me-2"></i>Edit
        </a>
        <form action="<?php echo e(route('admin.visi-misi.destroy', $visiMisi->id)); ?>" method="POST"
              onsubmit="return confirm('Yakin ingin menghapus visi & misi ini?')">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="btn btn-danger px-4">
                <i class="bi bi-trash-fill me-2"></i>Hapus
            </button>
        </form>
    </div>

    <?php else: ?>

    
    <div class="card border-0 shadow-sm text-center py-5" style="border-radius: 14px;">
        <div class="card-body">
            <i class="bi bi-journal-bookmark fs-1 text-muted mb-3 d-block"></i>
            <h5 class="text-muted fw-semibold">Belum Ada Data Visi & Misi</h5>
            <p class="text-muted small mb-4">Tambahkan visi & misi sekolah terlebih dahulu</p>
            <a href="<?php echo e(route('admin.visi-misi.create')); ?>" class="btn btn-primary px-4">
                <i class="bi bi-plus-circle me-2"></i>Tambah Visi Misi
            </a>
        </div>
    </div>

    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XAMPP\htdocs\PA3\sistem_informasi_psb\sistem_informasi_psb\resources\views/admin/visi-misi/index.blade.php ENDPATH**/ ?>