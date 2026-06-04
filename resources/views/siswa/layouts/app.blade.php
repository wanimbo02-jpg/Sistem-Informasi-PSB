<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Siswa Dashboard') - PPDB SMA Negeri Karubaga</title>

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
        }
        .wrapper {
            display: flex;
            width: 100%;
        }
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #17a2b8;
            color: #fff;
            transition: all 0.3s;
            height: 100vh;
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
            background: #138496;
            border-bottom: 1px solid #1faec9;
        }
        #sidebar ul.components {
            padding: 20px 0;
        }
        #sidebar ul li a {
            padding: 12px 20px;
            display: block;
            color: #e0f2fe;
            text-decoration: none;
            transition: 0.3s;
        }
        #sidebar ul li a:hover {
            background: #138496;
            color: #fff;
        }
        #sidebar ul li.active > a {
            background: #ffc107;
            color: #343a40;
        }
        #sidebar ul li a i {
            margin-right: 10px;
            width: 20px;
        }
        #content {
            width: calc(100% - 250px);
            margin-left: 250px;
            transition: all 0.3s;
            min-height: 100vh;
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
        }
        .footer {
            background: #fff;
            padding: 15px 20px;
            border-top: 1px solid #dee2e6;
            font-size: 14px;
        }
        .status-card {
            border-radius: 10px;
            border-left: 4px solid;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="wrapper">
        @include('siswa.layouts.sidebar')

        <div id="content">
            @include('siswa.layouts.navbar')

            <div class="main-content">
                @yield('content')
            </div>

            @include('siswa.layouts.footer')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar, #content').toggleClass('active');
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
