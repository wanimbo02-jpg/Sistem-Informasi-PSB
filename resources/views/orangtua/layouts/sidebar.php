<nav id="sidebar">
    <div class="sidebar-header text-center">
        <h5 class="mb-1 text-white">PPDB Orang Tua</h5>
        <small class="text-white-50">SMA Negeri Karubaga</small>
    </div>

    <ul class="list-unstyled components">
        <li class="active">
            <a href="{{ route('orangtua.dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>

        <li>
            <a href="#dataAnakSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="bi bi-people"></i> Data Anak
            </a>
            <ul class="collapse list-unstyled" id="dataAnakSubmenu">
                <li>
                    <a href="#">
                        <i class="bi bi-person"></i> Profil Anak
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-file-text"></i> Data Pendaftaran
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-file-check"></i> Status Pendaftaran
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-file-earmark-check"></i> Hasil Seleksi
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#nilaiAnakSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="bi bi-bar-chart"></i> Nilai Anak
            </a>
            <ul class="collapse list-unstyled" id="nilaiAnakSubmenu">
                <li>
                    <a href="#">
                        <i class="bi bi-file-text"></i> Nilai Ujian
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-file-earmark-bar-graph"></i> Rapor
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-download"></i> Unduh Nilai
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#informasiSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="bi bi-info-circle"></i> Informasi
            </a>
            <ul class="collapse list-unstyled" id="informasiSubmenu">
                <li>
                    <a href="#">
                        <i class="bi bi-calendar"></i> Jadwal Penting
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-megaphone"></i> Pengumuman
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-newspaper"></i> Berita
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#komunikasiSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="bi bi-chat"></i> Komunikasi
            </a>
            <ul class="collapse list-unstyled" id="komunikasiSubmenu">
                <li>
                    <a href="#">
                        <i class="bi bi-envelope"></i> Pesan
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-telephone"></i> Hubungi Sekolah
                    </a>
                </li>
            </ul>
        </li>
    </ul>

    <div class="p-3 border-top border-warning">
        <div class="small text-white-50">
            <i class="bi bi-info-circle"></i> Pantau perkembangan anak Anda
        </div>
    </div>
</nav>
