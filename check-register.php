<?php

echo "<h1>🔍 CEK STATUS HALAMAN REGISTER</h1>";

// Load Laravel
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "<div class='status-card'>";
echo "<h2>Status Modul Register:</h2>";

try {
    $isAktif = \App\Models\HakAkses::isModulAktif('user');
    
    if ($isAktif) {
        echo "<div class='alert alert-success'>";
        echo "<h3>✅ Modul Register AKTIF</h3>";
        echo "<p>Halaman register seharusnya bisa diakses</p>";
        echo "</div>";
    } else {
        echo "<div class='alert alert-danger'>";
        echo "<h3>❌ Modul Register TIDAK AKTIF</h3>";
        echo "<p>Halaman register disembunyikan oleh middleware</p>";
        echo "<p><strong>Penyebab:</strong> Modul 'user' dinonaktifkan di database</p>";
        echo "</div>";
    }
    
} catch (Exception $e) {
    echo "<div class='alert alert-warning'>";
    echo "<h3>⚠️ Error Checking Status</h3>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "</div>";
}

echo "</div>";

echo "<div class='card'>";
echo "<div class='card-header'>";
echo "<h3>🔧 SOLUSI PERBAIKAN</h3>";
echo "</div>";
echo "<div class='card-body'>";

if (isset($_POST['fix_register'])) {
    try {
        // Aktifkan modul user
        \DB::table('hak_akses')
            ->where('modul', 'user')
            ->update(['status' => 'aktif']);
            
        echo "<div class='alert alert-success'>";
        echo "<h3>✅ BERHASIL DIPERBAIKI!</h3>";
        echo "<p>Modul register telah diaktifkan</p>";
        echo "<p><a href='/register' class='btn btn-primary'>Buka Halaman Register</a></p>";
        echo "</div>";
        
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>";
        echo "<h3>❌ GAGAL MEMPERBAIKI</h3>";
        echo "<p>" . $e->getMessage() . "</p>";
        echo "</div>";
    }
} else {
    echo "<form method='post'>";
    echo "<h4>🚀 Aktifkan Modul Register:</h4>";
    echo "<p>Klik tombol di bawah untuk mengaktifkan kembali halaman register:</p>";
    echo "<button type='submit' name='fix_register' class='btn btn-success btn-lg'>";
    echo "🔧 AKTIFKAN REGISTER SEKARANG";
    echo "</button>";
    echo "</form>";
}

echo "</div>";
echo "</div>";

echo "<div class='card'>";
echo "<div class='card-header'>";
echo "<h3>📋 INFORMASI LENGKAP</h3>";
echo "</div>";
echo "<div class='card-body'>";
echo "<h4>🔍 Penyebab Halaman Register Hilang:</h4>";
echo "<ol>";
echo "<li><strong>Middleware CheckHakAksesRegister:</strong> Menyaring akses ke halaman register</li>";
echo "<li><strong>Modul 'user' Tidak Aktif:</strong> Dinonaktifkan di tabel hak_akses</li>";
echo "<li><strong>Redirect ke Login:</strong> User dialihkan ke halaman login dengan pesan error</li>";
echo "</ol>";

echo "<h4>✅ Setelah Diperbaiki:</h4>";
echo "<ul>";
echo "<li>✅ Halaman register bisa diakses kembali</li>";
echo "<li>✅ Link 'Daftar Sekarang' berfungsi normal</li>";
echo "<li>✅ User bisa registrasi akun baru</li>";
echo "<li>✅ Email verification berfungsi normal</li>";
echo "</ul>";

echo "<h4>🔗 Link Akses:</h4>";
echo "<p><a href='/register' class='btn btn-info'>📝 Halaman Register</a></p>";
echo "<p><a href='/login' class='btn btn-secondary'>🔐 Halaman Login</a></p>";

echo "</div>";
echo "</div>";

?>

<style>
body {
    font-family: Arial, sans-serif;
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background: #f5f5f5;
}

.status-card {
    background: white;
    padding: 20px;
    border-radius: 8px;
    margin: 20px 0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.card {
    background: white;
    border-radius: 8px;
    margin: 20px 0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    overflow: hidden;
}

.card-header {
    background: #007bff;
    color: white;
    padding: 15px 20px;
}

.card-body {
    padding: 20px;
}

.alert {
    padding: 15px;
    border-radius: 8px;
    margin: 20px 0;
    border-left: 4px solid;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border-left-color: #28a745;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
    border-left-color: #dc3545;
}

.alert-warning {
    background: #fff3cd;
    color: #856404;
    border-left-color: #ffc107;
}

.alert-info {
    background: #d1ecf1;
    color: #0c5460;
    border-left-color: #17a2b8;
}

.btn {
    padding: 12px 24px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    font-weight: bold;
    transition: all 0.3s ease;
    margin: 5px;
}

.btn-success {
    background: #28a745;
    color: white;
}

.btn-success:hover {
    background: #218838;
    transform: translateY(-2px);
}

.btn-primary {
    background: #007bff;
    color: white;
}

.btn-primary:hover {
    background: #0056b3;
}

.btn-info {
    background: #17a2b8;
    color: white;
}

.btn-info:hover {
    background: #138496;
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #545b62;
}

.btn-lg {
    padding: 16px 32px;
    font-size: 18px;
}

h1, h2, h3, h4 {
    color: #333;
}

ol, ul {
    padding-left: 20px;
}

ol li, ul li {
    margin-bottom: 8px;
}
</style>
