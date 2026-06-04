

<?php $__env->startSection('title', 'Tambah Struktur Organisasi - Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4">

    
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="<?php echo e(route('admin.struktur-organisasi.index')); ?>" class="btn btn-light border px-3">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h4 class="fw-bold mb-0">Tambah Anggota Struktur Organisasi</h4>
            <p class="text-muted mb-0 small">Isi data jabatan dan nama lengkap</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 14px; overflow: hidden;">
        <div class="card-header border-0 py-3 px-4" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
            <div class="d-flex align-items-center gap-2 text-white">
                <i class="bi bi-plus-circle-fill fs-5"></i>
                <span class="fw-bold">Formulir Tambah Anggota</span>
            </div>
        </div>
        <div class="card-body p-4">
            <form action="<?php echo e(route('admin.struktur-organisasi.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="row g-4">

                    
                    <div class="col-md-6">
                        <label for="judul_utama" class="form-label fw-semibold">
                            <i class="bi bi-type-h1 text-primary me-1"></i>Judul Utama
                        </label>
                        <input type="text"
                               class="form-control <?php $__errorArgs = ['judul_utama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="judul_utama" name="judul_utama"
                               value="<?php echo e(old('judul_utama', 'STRUKTUR ORGANISASI')); ?>"
                               placeholder="Contoh: STRUKTUR ORGANISASI"
                               required>
                        <?php $__errorArgs = ['judul_utama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <small class="text-muted">Judul yang tampil di atas struktur organisasi.</small>
                    </div>

                    
                    <div class="col-md-6">
                        <label for="sub_judul" class="form-label fw-semibold">
                            <i class="bi bi-type-h2 text-success me-1"></i>Sub Judul
                        </label>
                        <input type="text"
                               class="form-control <?php $__errorArgs = ['sub_judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="sub_judul" name="sub_judul"
                               value="<?php echo e(old('sub_judul', 'SMA NEGERI KARUBAGA')); ?>"
                               placeholder="Contoh: SMA NEGERI KARUBAGA"
                               required>
                        <?php $__errorArgs = ['sub_judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <small class="text-muted">Sub judul yang tampil di bawah judul utama.</small>
                    </div>

                    
                    <div class="col-md-6">
                        <label for="jabatan" class="form-label fw-semibold">
                            <i class="bi bi-briefcase text-primary me-1"></i>Jabatan
                        </label>
                        <input type="text"
                               class="form-control <?php $__errorArgs = ['jabatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="jabatan" name="jabatan"
                               value="<?php echo e(old('jabatan')); ?>"
                               placeholder="Contoh: KEPALA SEKOLAH, SEKRETARIS 1"
                               required>
                        <?php $__errorArgs = ['jabatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <small class="text-muted">Tulis jabatan dengan huruf kapital.</small>
                    </div>

                    
                    <div class="col-md-6">
                        <label for="nama" class="form-label fw-semibold">
                            <i class="bi bi-person text-success me-1"></i>Nama Lengkap
                        </label>
                        <input type="text"
                               class="form-control <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="nama" name="nama"
                               value="<?php echo e(old('nama')); ?>"
                               placeholder="Contoh: Dra. Maria Kogoya, M.Pd"
                               required>
                        <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="col-md-6">
                        <label for="urutan" class="form-label fw-semibold">
                            <i class="bi bi-sort-numeric-up text-warning me-1"></i>Urutan Tampil
                        </label>
                        <input type="number"
                               class="form-control <?php $__errorArgs = ['urutan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="urutan" name="urutan"
                               value="<?php echo e(old('urutan', 1)); ?>"
                               min="0" required>
                        <?php $__errorArgs = ['urutan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <small class="text-muted">
                            <strong>0</strong> = Kepala Sekolah (paling atas). 
                            Angka lebih besar = posisi lebih bawah.
                        </small>
                    </div>

                    
                    <div class="col-md-6">
                        <label for="foto" class="form-label fw-semibold">
                            <i class="bi bi-image text-info me-1"></i>Foto
                        </label>
                        <input type="file"
                               class="form-control <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="foto" name="foto"
                               accept="image/jpg,image/jpeg,image/png,image/webp"
                               onchange="previewFoto(this)">
                        <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <small class="text-muted">Format: JPG, PNG, WEBP. Maks 2MB.</small>

                        
                        <div id="fotoPreview" class="mt-3" style="display:none;">
                            <img id="previewImg"
                                 src=""
                                 alt="Preview"
                                 style="width:100px;height:100px;border-radius:50%;object-fit:cover;border:3px solid #2c5282;">
                        </div>
                    </div>

                    
                    <div class="col-12">
                        <label for="teks_bawah_foto" class="form-label fw-semibold">
                            <i class="bi bi-card-text text-warning me-1"></i>Teks di Bawah Foto
                        </label>
                        <textarea
                               class="form-control <?php $__errorArgs = ['teks_bawah_foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="teks_bawah_foto" name="teks_bawah_foto"
                               rows="6"
                               placeholder="Tulis teks deskripsi atau informasi tambahan di sini (bebas tanpa batas karakter)"><?php echo e(old('teks_bawah_foto')); ?></textarea>
                        <?php $__errorArgs = ['teks_bawah_foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <small class="text-muted">Teks deskripsi yang tampil terpisah di bawah foto dan nama (bebas tanpa batas karakter).</small>
                    </div>

                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <a href="<?php echo e(route('admin.struktur-organisasi.index')); ?>" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary px-5">
                        <i class="bi bi-save me-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function previewFoto(input) {
    const preview = document.getElementById('fotoPreview');
    const img     = document.getElementById('previewImg');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { img.src = e.target.result; preview.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XAMPP\htdocs\PA3\sistem_informasi_psb\sistem_informasi_psb\resources\views/admin/struktur-organisasi/create.blade.php ENDPATH**/ ?>