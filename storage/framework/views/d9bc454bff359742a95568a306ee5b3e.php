<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
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
            align-items: flex-start;
        }
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #343a40;
            color: #fff;
            transition: all 0.3s;
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
        }
        #sidebar.active {
            margin-left: -250px;
        }
        #sidebar .sidebar-header {
            padding: 20px;
            background: #2c3136;
            border-bottom: 1px solid #4a4f55;
        }
        #sidebar ul.components {
            padding: 20px 0;
        }
        #sidebar ul li a {
            padding: 12px 20px;
            display: block;
            color: #c2c7d0;
            text-decoration: none;
            transition: 0.3s;
        }
        #sidebar ul li a:hover {
            background: #2c3136;
            color: #fff;
        }
        #sidebar ul li.active > a {
            background: #007bff;
            color: #fff;
        }
        #sidebar ul li a i {
            margin-right: 10px;
            width: 20px;
        }
        #content {
            width: calc(100% - 250px);
            margin-left: 250px;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
        }
        #content.active {
            width: 100%;
            margin-left: 0;
        }
        .navbar-custom {
            background: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,.08);
            padding: 15px 20px;
        }
        .main-content {
            padding: 20px;
            flex: 1;
        }
        .card-stats {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,.04);
            transition: transform 0.2s;
        }
        .card-stats:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,.1);
        }
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
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
        .footer {
            display: none;
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php echo $__env->make('admin.layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Page Content -->
        <div id="content">
            <!-- Navbar -->
            <?php echo $__env->make('admin.layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- Main Content -->
            <div class="main-content">
                <?php echo $__env->yieldContent('content'); ?>
            </div>

            <!-- Footer -->
            <?php echo $__env->make('admin.layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Toggle Sidebar -->
    <script>
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar, #content').toggleClass('active');
            });
        });
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\XAMPP\htdocs\PA3\sistem_informasi_psb\sistem_informasi_psb\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>