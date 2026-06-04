<nav id="sidebar">
    <style>
        /* ===== ANIMASI SIDEBAR ===== */
        /* Animasi gradient background */
        #sidebar {
            min-width: 260px;
            max-width: 260px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 5px 0 25px rgba(0,0,0,0.15);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow: hidden;
            z-index: 1000;
        }

        #sidebar::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            animation: rotate 20s linear infinite;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Animasi untuk menu items */
        #sidebar ul li {
            position: relative;
            z-index: 1;
            transition: all 0.3s ease;
        }

        /* Header */
        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.15);
            position: relative;
            z-index: 1;
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Menu Items */
        #sidebar ul.components {
            padding: 15px 0;
            padding-bottom: 80px;
            position: relative;
            z-index: 1;
        }

        /* Link styles */
        #sidebar ul li a {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            position: relative;
            overflow: hidden;
            gap: 10px;
        }

        /* Animasi hover untuk link */
        #sidebar ul li a::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 215, 0, 0.1);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.5s, height 0.5s;
            z-index: -1;
        }

        #sidebar ul li a:hover::before {
            width: 200px;
            height: 200px;
        }

        #sidebar ul li a:hover {
            color: #ffd700 !important;
            transform: translateX(5px);
        }

        /* Icon styles */
        #sidebar ul li a i {
            font-size: 1.2rem;
            min-width: 25px;
            transition: all 0.3s ease;
        }

        #sidebar ul li a:hover i {
            color: #ffd700;
            transition: all 0.3s;
        }

        /* Active menu */
        #sidebar ul li.active a {
            position: relative;
            background: rgba(255, 215, 0, 0.1);
        }

        #sidebar ul li.active a::after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: #ffd700;
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

        /* Dropdown toggle */
        .dropdown-toggle::after {
            transition: transform 0.3s ease;
        }

        .dropdown-toggle[aria-expanded="true"]::after {
            transform: rotate(180deg);
        }

        /* Submenu styles */
        #sidebar ul ul {
            background: rgba(0,0,0,0.15);
            border-radius: 0 0 10px 10px;
            margin: 2px 0 5px 0;
            position: relative;
            overflow: hidden;
        }

        #sidebar ul ul li a {
            padding: 10px 20px 10px 45px;
            font-size: 0.9rem;
            background: transparent;
            position: relative;
        }

        #sidebar ul ul li a::after {
            content: '';
            position: absolute;
            left: 20px;
            top: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255,255,255,0.5);
            border-radius: 50%;
            transform: translateY(-50%);
            transition: all 0.3s;
        }

        #sidebar ul ul li a:hover::after {
            background: #ffd700;
            transform: scale(1.5) translateY(-30%);
        }

        /* Animasi untuk header */
        .sidebar-header {
            position: relative;
            z-index: 1;
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Animasi untuk footer */
        #sidebar .border-top {
            border-top-color: rgba(255,255,255,0.15) !important;
            padding: 20px;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1;
            animation: slideUp 0.5s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Efek ripple saat klik */
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 215, 0, 0.3);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* Animasi pulse untuk menu badge (jika ada) */
        .menu-badge {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        /* Animasi untuk teks */
        .sidebar-header h5 {
            animation: glow 2s ease-in-out infinite;
        }

        @keyframes glow {
            0%, 100% {
                text-shadow: 0 0 5px rgba(255,255,255,0.5);
            }
            50% {
                text-shadow: 0 0 15px rgba(255,255,255,0.8);
            }
        }
    </style>

    <div class="sidebar-header text-center">
        <h5 class="mb-1 text-white">PPDB Siswa</h5>
        <small class="text-white-50">SMA Negeri Karubaga</small>
    </div>

    <ul class="list-unstyled components">
        <li class="active">
            <a href="{{ route('guru.dashboard') }}" class="menu-link">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>

        <li>
            <a href="#pendaftaranSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle menu-link">
                <i class="bi bi-pencil-square"></i> Pendaftaran
            </a>
            <ul class="collapse list-unstyled" id="pendaftaranSubmenu">
                <li>
                    <a href="{{ route('guru.data-siswa.index') }}" class="submenu-link">
                        <i class="bi bi-people"></i> Data Siswa
                    </a>
                </li>
                <li>
                    <a href="{{ route('guru.data-guru.index') }}" class="submenu-link">
                        <i class="bi bi-person-badge"></i> Data Guru
                    </a>
                </li>
                <li>
                    <a href="{{ route('guru.data-orang-tua.index') }}" class="submenu-link">
                        <i class="bi bi-person-heart"></i> Data Orang Tua
                    </a>
                </li>
            </ul>
        </li>

          <li>
            <a href="#seleksiSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle menu-link">
                <i class="bi bi-trophy"></i> Seleksi
            </a>
            <ul class="collapse list-unstyled" id="seleksiSubmenu">
                <li>
                    <a href="{{ route('guru.seleksi-administrasi.index') }}" class="submenu-link">
                        <i class="bi bi-funnel"></i> Seleksi Administrasi
                    </a>
                </li>
                <li>
                    <a href="{{ route('guru.siswa-diseleksi.index') }}" class="submenu-link">
                        <i class="bi bi-check2-circle"></i> Siswa yang sudah diseleksi
                    </a>
                </li>
                <li>
                    <a href="{{ route('guru.pengumuman.index') }}" class="submenu-link">
                        <i class="bi bi-megaphone"></i> Pengumuman
                    </a>
                </li>
                <!-- <li>
                    <a href="#" class="submenu-link">
                        <i class="bi bi-sort-numeric-down"></i> Peringkat
                    </a>
                </li>
                <li>
                    <a href="#" class="submenu-link">
                        <i class="bi bi-megaphone"></i> Pengumuman
                    </a>
                </li> -->
            </ul>
        </li>

        <li>
            <a href="#kelasMkSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle menu-link">
                <i class="bi bi-journal-text"></i> Manajemen Akademik
            </a>
            <ul class="collapse list-unstyled" id="kelasMkSubmenu">
                <li>
                    <a href="{{ route('guru.data-kelas.index') }}" class="submenu-link">
                        <i class="bi bi-building"></i> Data Kelas
                    </a>
                </li>
                <li>
                    <a href="{{ route('guru.data-mata-pelajaran.index') }}" class="submenu-link">
                        <i class="bi bi-book"></i> Data Mata Pelajaran
                    </a>
                </li>
            </ul>
        </li>

        <!-- <li>
            <a href="#masterDataSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle menu-link">
                <i class="bi bi-database"></i> Master Data
            </a>
            <ul class="collapse list-unstyled" id="masterDataSubmenu"> -->
                <!-- <li>
                    <a href="{{ route('admin.pendaftaran.index') }}" class="submenu-link">
                        <i class="bi bi-file-earmark-plus"></i> Daftar Baru
                    </a>
                </li> -->
                <!-- <li>
                    <a href="#" class="submenu-link">
                        <i class="bi bi-list-check"></i> Verifikasi Berkas
                    </a>
                </li>
                <li>
                    <a href="#" class="submenu-link">
                        <i class="bi bi-check2-circle"></i> Konfirmasi
                    </a>
                </li>
                <li>
                    <a href="#" class="submenu-link">
                        <i class="bi bi-file-pdf"></i> Cetak Formulir
                    </a>
                </li>
            </ul>
        </li> -->

      

        <!-- <li>
            <a href="#laporanSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle menu-link">
                <i class="bi bi-file-text"></i> Laporan
            </a>
            <ul class="collapse list-unstyled" id="laporanSubmenu">
                <li>
                    <a href="#" class="submenu-link">
                        <i class="bi bi-file-spreadsheet"></i> Laporan Harian
                    </a>
                </li>
                <li>
                    <a href="#" class="submenu-link">
                        <i class="bi bi-file-earmark-bar-graph"></i> Laporan Bulanan
                    </a>
                </li>
                <li>
                    <a href="#" class="submenu-link">
                        <i class="bi bi-file-earmark-pdf"></i> Laporan Tahunan
                    </a>
                </li>
                <li>
                    <a href="#" class="submenu-link">
                        <i class="bi bi-printer"></i> Cetak Laporan
                    </a>
                </li>
            </ul>
        </li> -->

        <li>
            <a href="#pengaturanSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle menu-link">
                <i class="bi bi-gear"></i> Pengaturan
            </a>
            <ul class="collapse list-unstyled" id="pengaturanSubmenu">
                <!-- <li>
                    <a href="#" class="submenu-link">
                        <i class="bi bi-calendar"></i> Tahun Ajaran
                    </a>
                </li>
                <li>
                    <a href="#" class="submenu-link">
                        <i class="bi bi-sliders"></i> Konfigurasi
                    </a>
                </li>
                <li> -->
                    <a href="#" class="submenu-link">
                        <i class="bi bi-shield-lock"></i> Pengaturan akun
                    </a>
                </li>
            </ul>
        </li>
    </ul>

    <div class="p-3 border-top border-white-50">
        <div class="small text-white-50">
            <i class="bi bi-info-circle"></i> PPDB {{ date('Y') }}
        </div>
    </div>
</nav>

<script>
    // Efek ripple saat klik menu
    document.querySelectorAll('#sidebar ul li a').forEach(link => {
        link.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            ripple.className = 'ripple';
            ripple.style.left = e.offsetX + 'px';
            ripple.style.top = e.offsetY + 'px';
            
            // Hapus ripple sebelumnya jika ada
            const existingRipple = this.querySelector('.ripple');
            if (existingRipple) {
                existingRipple.remove();
            }
            
            this.appendChild(ripple);
            
            // Hapus ripple setelah animasi selesai
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Animasi hover untuk menu
    document.querySelectorAll('#sidebar ul li a').forEach(link => {
        link.addEventListener('mouseenter', function() {
            this.style.transition = 'all 0.3s ease';
        });
    });

    // Simpan status dropdown di localStorage (opsional)
    document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
        toggle.addEventListener('click', function() {
            const targetId = this.getAttribute('href').replace('#', '');
            const target = document.getElementById(targetId);
            
            setTimeout(() => {
                if (target.classList.contains('show')) {
                    localStorage.setItem(targetId, 'open');
                } else {
                    localStorage.removeItem(targetId);
                }
            }, 300);
        });
    });
</script>