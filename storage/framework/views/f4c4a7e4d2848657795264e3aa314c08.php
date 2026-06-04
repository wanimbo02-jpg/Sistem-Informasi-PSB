<style>
/* ===== ANIMASI SIDEBAR SEDERHANA & ELEGAN ===== */
/* Warna emas yang digunakan: #b8860b (DarkGoldenRod) - elegan tidak menyilaukan */

/* Warna dasar sidebar - GANTI DENGAN WARNA EMAS GELAP ELEGAN */
#sidebar {
    background: linear-gradient(180deg, #20819f 0%, #6B4E1A 100%) !important;
    /* Atau jika ingin warna solid, gunakan: background: #7A5C1A !important; */
}

/* 1. Animasi hover pada link menu utama */
#sidebar ul li a {
    transition: all 0.25s ease;
    position: relative;
    color: rgba(255, 255, 255, 0.9);
}

#sidebar ul li a:hover {
    background: rgba(27, 124, 180, 0.2);
    padding-left: 25px;
    border-left-color: #DAA520;
}

/* 2. Animasi icon saat hover */
#sidebar ul li a i {
    transition: all 0.25s ease;
}

#sidebar ul li a:hover i {
    transform: scale(1.1);
    color: #F0B90B;
}

/* 3. Animasi submenu saat membuka/tutup */
#sidebar ul ul {
    transition: all 0.25s ease;
    overflow: hidden;
    background: rgba(0, 0, 0, 0.15);
}

#sidebar ul ul.collapsing {
    transition: height 0.25s ease;
}

#sidebar ul ul li a {
    transition: all 0.2s ease;
    padding-left: 35px;
}

#sidebar ul ul li a:hover {
    padding-left: 42px;
    background: rgba(0, 0, 0, 0.2);
}

/* 4. Animasi dropdown arrow */
.dropdown-toggle::after {
    transition: transform 0.25s ease;
}

.dropdown-toggle[aria-expanded="true"]::after {
    transform: rotate(180deg);
}

/* 5. Animasi active menu */
#sidebar ul li.active > a {
    background: rgba(0, 0, 0, 0.25);
    border-left-color: #F0B90B;
    position: relative;
}

#sidebar ul li.active > a::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 3px;
    background: #F0B90B;
    animation: slideIn 0.3s ease;
}

@keyframes slideIn {
    from {
        height: 0;
        top: 50%;
    }
    to {
        height: 100%;
        top: 0;
    }
}

/* 6. Animasi fade-in untuk submenu items */
#sidebar ul ul li {
    animation: fadeInUp 0.2s ease forwards;
    opacity: 0;
}

#sidebar ul ul li:nth-child(1) { animation-delay: 0.05s; }
#sidebar ul ul li:nth-child(2) { animation-delay: 0.1s; }
#sidebar ul ul li:nth-child(3) { animation-delay: 0.15s; }
#sidebar ul ul li:nth-child(4) { animation-delay: 0.2s; }
#sidebar ul ul li:nth-child(5) { animation-delay: 0.25s; }
#sidebar ul ul li:nth-child(6) { animation-delay: 0.3s; }

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(8px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* 7. Animasi header */
.sidebar-header {
    transition: all 0.3s ease;
    border-bottom: 1px solid rgba(218, 165, 32, 0.3);
}

.sidebar-header:hover {
    transform: translateY(-2px);
}

.sidebar-header h5 {
    transition: all 0.3s ease;
    color: #F0B90B;
}

/* 8. Animasi footer */
#sidebar .border-top {
    transition: all 0.3s ease;
    border-top-color: rgba(218, 165, 32, 0.3) !important;
}

#sidebar .border-top:hover {
    background: rgba(48, 132, 187, 0.2);
}

/* 9. Efek ripple ringan saat klik (opsional) */
#sidebar ul li a {
    position: relative;
    overflow: hidden;
}

#sidebar ul li a:active::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(218, 165, 32, 0.3);
    transform: translate(-50%, -50%);
    animation: ripple 0.4s ease-out;
}

@keyframes ripple {
    to {
        width: 200px;
        height: 200px;
        opacity: 0;
    }
}

/* 10. Scrollbar custom yang lebih halus */
#sidebar::-webkit-scrollbar {
    width: 4px;
}

#sidebar::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0.2);
    border-radius: 4px;
}

#sidebar::-webkit-scrollbar-thumb {
    background: rgba(218, 165, 32, 0.5);
    border-radius: 4px;
    transition: all 0.3s;
}

#sidebar::-webkit-scrollbar-thumb:hover {
    background: #DAA520;
}

/* 11. Tambahan efek untuk teks dan icon emas */
#sidebar .nav-link i {
    color: rgba(218, 165, 32, 0.8);
}

#sidebar .nav-link:hover i {
    color: #F0B90B;
}

/* 12. Efek untuk badge atau indikator */
.badge-emas {
    background: rgba(218, 165, 32, 0.2);
    color: #F0B90B;
    border: 1px solid rgba(218, 165, 32, 0.4);
}
</style>
<nav id="sidebar">
    <div class="sidebar-header text-center">
        <h5 class="mb-1 text-white">PPDB Admin</h5>
        <small class="text-secondary">SMA Negeri Karubaga</small>
    </div>

    <ul class="list-unstyled components">
        <li class="active">
            <a href="<?php echo e(route('admin.dashboard')); ?>">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>

         <li>
            <a href="#pendaftaranSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="bi bi-megaphone"></i> Informasi Publik
            </a>
            <ul class="collapse list-unstyled" id="pendaftaranSubmenu">
                 <li>
                    <a href="<?php echo e(route('admin.informasi.index')); ?>">
                        <i class="bi bi-info-circle"></i> Informasi
                    </a>
                </li>
                <li>
                    <a href="#">
                       <i class="bi bi-house-gear"></i> Kelola Homepage
                    </a>
                </li>
                <li>
                    <!-- <a href="#">
                        <i class="bi bi-check2-circle"></i> Konfirmasi
                    </a> -->
                </li>
                <li>
                    <!-- <a href="#">
                        <i class="bi bi-file-pdf"></i> Cetak Formulir
                    </a> -->
                </li>
            </ul>
        </li>




        <li>
            <a href="#masterDataSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="bi bi-database"></i> Mengelola Data
            </a>
            <ul class="collapse list-unstyled" id="masterDataSubmenu">
               
                <li>
                    <a href="<?php echo e(route('admin.visi-misi.index')); ?>">
                        <i class="bi bi-bullseye"></i> Visi Misi
                    </a>
                </li>
               
               
                <li>
                    <a href="<?php echo e(route('admin.struktur-organisasi.index')); ?>">
                        <i class="bi bi-diagram-3"></i> Struktur Organisasi
                    </a>
                </li>
            </ul>
        </li>

        
         <li>
    <a href="#galleryFasilitasSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="bi bi-images"></i> Gallery & Fasilitas
    </a>
    <ul class="collapse list-unstyled" id="galleryFasilitasSubmenu">
         <li>
         <a href="/admin/gallery">
            <i class="bi bi-images"></i> Gallery
            </a>
            </li>
         <li>
            <a href="<?php echo e(route('admin.fasilitas.index')); ?>">
              <i class="bi-building"></i> Fasilitas
            </a>
        </li>
    </ul>
    </li>

        <!-- <li>
            <a href="#laporanSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="bi bi-file-text"></i> Laporan
            </a>
            <ul class="collapse list-unstyled" id="laporanSubmenu">
                <li>
                    <a href="#">
                        <i class="bi bi-file-spreadsheet"></i> Laporan Harian
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-file-earmark-bar-graph"></i> Laporan Bulanan
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-file-earmark-pdf"></i> Laporan Tahunan
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-printer"></i> Cetak Laporan
                    </a>
                </li>
            </ul>
        </li> -->

        <li>
            <a href="#pengaturanSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="bi bi-gear"></i> Pengaturan
            </a>
            <ul class="collapse list-unstyled" id="pengaturanSubmenu">
                <li>
                    <a href="<?php echo e(route('admin.contacts.index')); ?>">
                        <i class="bi bi-envelope"></i> Kontak User
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-sliders"></i> Konfigurasi
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('admin.hak-akses.index')); ?>">
                        <i class="bi bi-shield-lock"></i> Hak Akses
                    </a>
                </li>
            </ul>
        </li>
    </ul>

    <div class="p-3 border-top border-secondary">
        <div class="small text-secondary">
            <i class="bi bi-info-circle"></i> PPDB <?php echo e(date('Y')); ?>

        </div>
    </div>
</nav>
<?php /**PATH D:\XAMPP\htdocs\PA3\sistem_informasi_psb\sistem_informasi_psb\resources\views/admin/layouts/sidebar.blade.php ENDPATH**/ ?>