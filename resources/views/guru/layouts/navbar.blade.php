<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="btn btn-outline-secondary">
            <i class="bi bi-list"></i>
        </button>

        <div class="ms-auto d-flex align-items-center">
            <!-- Notifications -->
            <div class="dropdown me-3">
                <button class="btn btn-light position-relative" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        3
                    </span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><h6 class="dropdown-header">Notifikasi</h6></li>
                    <li><a class="dropdown-item" href="#">
                        <small class="text-muted">Pendaftar baru: 5 siswa</small>
                    </a></li>
                    <li><a class="dropdown-item" href="#">
                        <small class="text-muted">Verifikasi pending: 3 berkas</small>
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-center" href="#">Lihat Semua</a></li>
                </ul>
            </div>

            <!-- User Dropdown -->
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                        <span>A</span>
                    </div>
                    <div>
                        <small class="text-muted d-block">Guru</small>
                        <strong>{{ Auth::user()->name ?? 'Guru' }}</strong>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
