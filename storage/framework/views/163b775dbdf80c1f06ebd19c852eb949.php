

<?php $__env->startSection('title', 'Visi & Misi SMA Negeri Karubaga'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .navbar {
        padding: 1.5rem 0 !important;
    }
    .navbar-brand {
        font-size: 1.5rem !important;
        font-weight: 700 !important;
    }
    .nav-link {
        font-weight: 500;
        color: #ffffff;
        margin: 0 0.5rem;
        transition: color 0.3s ease;
    }
</style>
<div class="py-5">
    <div class="container">
        
        <!-- Judul -->
        <h2 style="text-align: center; color: #1e3c72; margin-bottom: 0.5rem; font-weight: bold;">VISI & MISI</h2>
        <h4 style="text-align: center; color: #2c5282; margin-bottom: 3rem;">SMA NEGERI KARUBAGA</h4>
        
        <!-- Konten 2 Kolom: Kiri Foto Kepala Sekolah, Kanan Visi Misi -->
        <div style="display: flex; flex-wrap: wrap; gap: 3rem; align-items: stretch;">
            
            <!-- Kolom Kiri: Foto Kepala Sekolah -->
            <div style="flex: 1; min-width: 260px;">
                <div style="background: white; border-radius: 12px; padding: 1.5rem; text-align: center; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    <!-- Foto Kepala Sekolah -->
                    <div style="width: 180px; height: 180px; margin: 0 auto 1rem; border-radius: 50%; overflow: hidden; border: 4px solid #2c5282; background: #e2e8f0;">
                        <img src="<?php echo e(asset('images/CT_Freedd.jpg')); ?>" 
                             alt="Foto Kepala Sekolah" 
                             style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="font-weight: bold; font-size: 1rem; color: #2d3748;">KEPALA SEKOLAH</div>
                    <div style="font-size: 1.1rem; font-weight: bold; color: #1a202c; margin: 0.5rem 0;">Dra. Maria Kogoya, M.Pd</div>
                    <div style="font-size: 0.8rem; color: #718096;">NIP. 19750820 200312 2 005</div>
                    
                    <!-- Garis pemisah sederhana -->
                    <div style="width: 50px; height: 2px; background: #cbd5e0; margin: 1rem auto;"></div>
                    
                    <!-- Motto Sekolah -->
                    <div style="font-size: 0.85rem; color: #2c5282; font-style: italic;">
                        Selangkah Lebih Depan
                    </div>
                </div>
            </div>
            
            <!-- Kolom Kanan: Visi dan Misi -->
            <div style="flex: 2; min-width: 280px;">
                <!-- Visi -->
                <div style="margin-bottom: 2rem;">
                    <div style="display: inline-block; background: #1e3c72; color: white; padding: 0.5rem 1.5rem; border-radius: 30px; margin-bottom: 1rem;">
                        <h5 style="margin: 0; font-weight: bold;">VISI</h5>
                    </div>
                    <p style="color: #2d3748; font-size: 1rem; line-height: 1.8; padding: 1rem; margin: 0; text-align: justify;">
                        <?php echo e($visiMisi->visi ?? 'Menjadi lembaga selangkah lebih depan dalam pengembangan talenta manusia yang memberikan kontribusi berarti pada inovasi teknologi dan keberlanjutan sosial.'); ?>

                    </p>
                </div>
                
                <!-- Misi -->
                <div>
                    <div style="display: inline-block; background: #1e3c72; color: white; padding: 0.5rem 1.5rem; border-radius: 30px; margin-bottom: 1rem;">
                        <h5 style="margin: 0; font-weight: bold;">MISI</h5>
                    </div>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <?php
                            $misiItems = $visiMisi->misi ?? 
                                "Menyelenggarakan pendidikan berkualitas yang berorientasi pada pengembangan karakter dan kompetensi siswa.
                                Mengembangkan potensi siswa dalam bidang akademik dan non-akademik.
                                Menciptakan lingkungan belajar yang kondusif, inovatif, dan berwawasan global.
                                Menjalin kerjasama dengan berbagai pihak untuk meningkatkan mutu pendidikan.";
                            $misiArray = explode("\n", $misiItems);
                        ?>
                        <?php $__currentLoopData = $misiArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $misiItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li style="margin-bottom: 1rem; display: flex; align-items: flex-start; gap: 0.8rem; padding: 0.8rem; border-radius: 12px;">
                            <span style="color: #4a5568; line-height: 1.6;"><?php echo e(trim($misiItem)); ?></span>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
        
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XAMPP\htdocs\PA3\sistem_informasi_psb\sistem_informasi_psb\resources\views/home/tentang/visi-misi.blade.php ENDPATH**/ ?>