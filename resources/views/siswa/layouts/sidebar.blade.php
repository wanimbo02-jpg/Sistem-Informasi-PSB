<nav id="sidebar">
    <div class="sidebar-header text-center">
        <h5 class="mb-1 text-white">PPDB Siswa</h5>
        <small class="text-white-50">SMA Negeri Karubaga</small>
    </div>

    <ul class="list-unstyled components">
        <li class="active">
            <a href="{{ route('siswa.dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>

        <li>
            <a href="#pendaftaranSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="bi bi-file-earmark-person"></i> Pendaftaran
            </a>
            <ul class="collapse list-unstyled" id="pendaftaranSubmenu">
                <li>
                    <a href="{{ route('siswa.pendaftaran.formulir') }}">
                        <i class="bi bi-pencil"></i> Formulir Pendaftaran
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-upload"></i> Upload Berkas
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-file-check"></i> Status Pendaftaran
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-printer"></i> Cetak Kartu Peserta
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#nilaiSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="bi bi-bar-chart"></i> Nilai
            </a>
            <ul class="collapse list-unstyled" id="nilaiSubmenu">
                <li>
                    <a href="#">
                        <i class="bi bi-file-text"></i> Lihat Nilai
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-download"></i> Unduh Nilai
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-file-earmark-bar-graph"></i> Rapor Sementara
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#jadwalSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="bi bi-calendar"></i> Jadwal
            </a>
            <ul class="collapse list-unstyled" id="jadwalSubmenu">
                <li>
                    <a href="#">
                        <i class="bi bi-clock"></i> Jadwal Pelajaran
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-calendar-check"></i> Jadwal Ujian
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-megaphone"></i> Pengumuman
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#dataSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="bi bi-database"></i> Data Pribadi
            </a>
            <ul class="collapse list-unstyled" id="dataSubmenu">
                <li>
                    <a href="#">
                        <i class="bi bi-person"></i> Profil Saya
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-pencil-square"></i> Edit Data
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#seleksiSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="bi bi-clipboard-check"></i> Seleksi
            </a>
            <ul class="collapse list-unstyled" id="seleksiSubmenu">
                <li>
                    <a href="#">
                        <i class="bi bi-file-earmark-text"></i> Seleksi Administrasi
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-trophy"></i> Hasil Seleksi
                    </a>
                </li>
            </ul>
        </li>
    </ul>

    <div class="p-3 border-top border-info">
        <div class="small text-white-50">
            <i class="bi bi-info-circle"></i> Status: Calon Siswa
        </div>
    </div>
</nav>
