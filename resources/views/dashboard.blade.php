<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: system-ui, -apple-system, sans-serif;
            background: #f0f2f5;
            min-height: 100vh;
        }

        .navbar {
            background: linear-gradient(135deg, #0047ab, #4169e1);
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            color: white !important;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .nav-link {
            color: rgba(240, 240, 240, 0.9) !important;
        }

        .nav-link:hover {
            color: white !important;
        }

        .container-fluid {
            padding: 20px 30px;
        }

        .welcome-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .welcome-card h1 {
            color: #0047ab;
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
        }

        .welcome-card h2 {
            color: #4169e1;
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .info-badge {
            background: #e8f0fe;
            color: #0047ab;
            padding: 8px 15px;
            border-radius: 20px;
            display: inline-block;
            font-size: 0.9rem;
        }

        .progress-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(255, 234, 234, 0.05);
        }

        .progress-steps {
            display: flex;
            justify-content: space-between;
            margin: 30px 0 20px;
            position: relative;
        }

        .progress-steps::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 3px;
            background: #e0e0e0;
            z-index: 1;
        }

        .step {
            position: relative;
            z-index: 2;
            background: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #999;
            border: 3px solid #e0e0e0;
        }

        .step.completed {
            background: #0047ab;
            border-color: #0047ab;
            color: white;
        }

        .step.active {
            border-color: #0047ab;
            color: #0047ab;
            font-weight: bold;
        }

        .step-label {
            text-align: center;
            margin-top: 10px;
            font-size: 0.9rem;
            color: #666;
        }

        .menu-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .menu-title {
            color: #0047ab;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #eef2f7;
        }

        .menu-item {
            padding: 10px 0;
            border-bottom: 1px solid #eef2f7;
        }

        .menu-item:last-child {
            border-bottom: none;
        }

        .menu-item .label {
            color: #666;
            font-size: 0.9rem;
        }

        .menu-item .value {
            color: #0047ab;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .data-form {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #0047ab, #4169e1);
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 500;
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,71,171,0.3);
        }

        .btn-outline-primary {
            color: #0047ab;
            border-color: #0047ab;
        }

        .btn-outline-primary:hover {
            background: #0047ab;
            color: white;
        }

        .info-box {
            background: #e8f0fe;
            border-left: 4px solid #0047ab;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .student-id {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 10px;
        }

        .student-id span {
            color: #0047ab;
            font-weight: 600;
        }

        .alert {
            border-radius: 10px;
        }

        .riwayat-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            color: #999;
        }

        .riwayat-card i {
            font-size: 3rem;
            color: #ddd;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa