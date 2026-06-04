<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $__env->yieldContent('title', 'Admin Dashboard'); ?> - PPDB SMA Negeri Karubaga</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        body {
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }
        .wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }
        #content {
            width: calc(100% - 260px);
            padding: 20px;
            min-height: 100vh;
            margin-left: 260px;
            transition: all 0.3s;
            box-sizing: border-box;
        }
        .card {
            margin-bottom: 1.5rem;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .navbar-custom {
            background: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,.08);
            padding: 15px 20px;
            margin-bottom: 20px;
            border-radius: 10px;
        }
        .dropdown-menu {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,.1);
            border-radius: 8px;
        }
        .dropdown-item {
            padding: 8px 20px;
        }
        .dropdown-item i {
            margin-right: 8px;
            width: 18px;
        }
        .dropdown-item:hover {
            background: #f8f9fa;
        }
    </style>
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php echo $__env->make('guru.layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Page Content -->
        <div id="content">
            <!-- Navbar hanya untuk Dashboard -->
            <?php if(request()->route()->getName() == 'guru.dashboard'): ?>
                <nav class="navbar navbar-expand-lg navbar-custom">
                    <div class="container-fluid">
                        <div class="ms-auto d-flex align-items-center">
                            <!-- User Dropdown -->
                            <div class="dropdown">
                                <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                                        <span>A</span>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Administrator</small>
                                        <strong><?php echo e(Auth::user()->name ?? 'Admin'); ?></strong>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="<?php echo e(route('guru.profile.index')); ?>"><i class="bi bi-person"></i> Profile</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Pengaturan Akun</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="bi bi-box-arrow-right"></i> Logout
                                        </a>
                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                            <?php echo csrf_field(); ?>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\XAMPP\htdocs\PA3\sistem_informasi_psb\sistem_informasi_psb\resources\views/guru/layouts/app.blade.php ENDPATH**/ ?>