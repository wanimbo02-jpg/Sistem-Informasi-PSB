<?php

echo "<h1>📧 FIX KIRIM KODE VERIFIKASI KE EMAIL</h1>";

// Baca file .env
$envFile = '.env';
$envContent = file_get_contents($envFile);

echo "<div class='alert alert-danger'>";
echo "<h3>❌ MASALAH: KODE VERIFIKASI TIDAK TERKIRIM</h3>";
echo "<p>Register berhasil tapi kode verifikasi tidak masuk ke email HP Anda</p>";
echo "</div>";

// Fix konfigurasi email
$newContent = $envContent;
$newContent = str_replace('MAIL_MAILER=log', 'MAIL_MAILER=smtp', $newContent);
$newContent = str_replace('MAIL_HOST=127.0.0.1', 'MAIL_HOST=smtp.gmail.com', $newContent);
$newContent = str_replace('MAIL_PORT=2525', 'MAIL_PORT=587', $newContent);
$newContent = str_replace('MAIL_USERNAME=null', 'MAIL_USERNAME=your-email@gmail.com', $newContent);
$newContent = str_replace('MAIL_PASSWORD=null', 'MAIL_PASSWORD=your-app-password', $newContent);
$newContent = str_replace('MAIL_FROM_ADDRESS="hello@example.com"', 'MAIL_FROM_ADDRESS=noreply@smanegerikarubaga.sch.id', $newContent);
$newContent = str_replace('MAIL_FROM_NAME="${APP_NAME}"', 'MAIL_FROM_NAME="SMA Negeri Karubaga"', $newContent);

// Tambahkan encryption
if (strpos($newContent, 'MAIL_ENCRYPTION=') === false) {
    $newContent .= "\nMAIL_ENCRYPTION=tls\n";
}

file_put_contents($envFile, $newContent);

echo "<div class='alert alert-success'>";
echo "<h3>✅ KONFIGURASI EMAIL DIPERBAIKI</h3>";
echo "<p>Sekarang siap kirim kode verifikasi ke email HP Anda</p>";
echo "</div>";

if (isset($_POST['setup_kode'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Update credentials
    $finalContent = file_get_contents($envFile);
    $finalContent = str_replace('MAIL_USERNAME=your-email@gmail.com', "MAIL_USERNAME=$email", $finalContent);
    $finalContent = str_replace('MAIL_PASSWORD=your-app-password', "MAIL_PASSWORD=$password", $finalContent);
    
    file_put_contents($envFile, $finalContent);
    
    echo "<div class='alert alert-success'>";
    echo "<h3>🎉 SETUP BERHASIL!</h3>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Status:</strong> Siap kirim kode verifikasi</p>";
    echo "</div>";
    
    echo "<div class='alert alert-info'>";
    echo "<h3>🔄 LANGKAH TERAKHIR:</h3>";
    echo "<ol>";
    echo "<li>Buka terminal</li>";
    echo "<li>Jalankan: <code>php artisan config:clear</code></li>";
    echo "<li>Restart server: <code>php artisan serve</code></li>";
    echo "<li>Register akun baru</li>";
    echo "<li>Cek email HP Anda untuk kode verifikasi</li>";
    echo "<li>Masukkan 6 digit kode</li>";
    echo "</ol>";
    echo "</div>";
    
} else {
    echo "<div class='card'>";
    echo "<div class='card-header'>";
    echo "<h3>📧 SETUP EMAIL UNTUK KODE VERIFIKASI</h3>";
    echo "</div>";
    echo "<div class='card-body'>";
    echo "<form method='post'>";
    
    echo "<div class='form-group'>";
    echo "<label>📧 Email Gmail Anda:</label>";
    echo "<input type='email' name='email' class='form-control' placeholder='your-email@gmail.com' required>";
    echo "<small>Email yang akan menerima kode verifikasi</small>";
    echo "</div>";
    
    echo "<div class='form-group'>";
    echo "<label>🔑 App Password Gmail:</label>";
    echo "<input type='password' name='password' class='form-control' placeholder='16-digit app password' required>";
    echo "<small>Dapatkan dari Google Account settings</small>";
    echo "</div>";
    
    echo "<button type='submit' name='setup_kode' class='btn btn-primary'>🚀 SETUP KIRIM KODE VERIFIKASI</button>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
}

echo "<div class='card'>";
echo "<div class='card-header'>";
echo "<h3>📱 CARA DAPAT APP PASSWORD GMAIL</h3>";
echo "</div>";
echo "<div class='card-body'>";
echo "<ol>";
echo "<li>Buka browser HP: myaccount.google.com</li>";
echo "<li>Login dengan Gmail Anda</li>";
echo "<li>Security → 2-Step Verification → Enable</li>";
echo "<li>App Passwords → Generate new</li>";
echo "<li>Select: Mail → Other → Generate</li>";
echo "<li>Nama: SMA Karubaga</li>";
echo "<li>Copy 16-digit password</li>";
echo "<li>Gunakan di form atas</li>";
echo "</ol>";
echo "</div>";
echo "</div>";

echo "<div class='alert alert-success'>";
echo "<h3>✅ HASIL SETELAH SETUP:</h3>";
echo "<p><strong>HANYA KODE VERIFIKASI YANG DIKIRIM:</strong></p>";
echo "<ul>";
echo "<li>✅ Register → 6 digit kode dikirim ke email HP</li>";
echo "<li>✅ Cek Gmail HP → Email dari SMA Negeri Karubaga</li>";
echo "<li>✅ Buka email → Lihat 6 digit kode</li>";
echo "<li>✅ Masukkan kode → Verifikasi berhasil</li>";
echo "<li>✅ Login → Akses sistem</li>";
echo "</ul>";
echo "<p><strong>TIDAK ADA YANG LAIN:</strong> Hanya kode verifikasi, tidak ada password atau tambahan lain.</p>";
echo "</div>";

echo "<div class='alert alert-warning'>";
echo "<h3>⚠️ PENTING:</h3>";
echo "<ul>";
echo "<li>Clear cache: php artisan config:clear (WAJIB)</li>";
echo "<li>Restart server: php artisan serve (WAJIB)</li>";
echo "<li>Cek folder spam jika tidak ada di inbox</li>";
echo "<li>Gunakan App Password Gmail, bukan password biasa</li>";
echo "</ul>";
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

.alert {
    padding: 15px;
    border-radius: 8px;
    margin: 20px 0;
    border-left: 4px solid;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
    border-left-color: #dc3545;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border-left-color: #28a745;
}

.alert-info {
    background: #d1ecf1;
    color: #0c5460;
    border-left-color: #17a2b8;
}

.alert-warning {
    background: #fff3cd;
    color: #856404;
    border-left-color: #ffc107;
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

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-control {
    width: 100%;
    padding: 12px;
    border: 2px solid #ddd;
    border-radius: 6px;
    font-size: 16px;
}

.form-control:focus {
    border-color: #007bff;
    outline: none;
}

.form-group small {
    display: block;
    margin-top: 5px;
    color: #666;
    font-size: 14px;
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
}

.btn-primary {
    background: #007bff;
    color: white;
}

.btn-primary:hover {
    background: #0056b3;
    transform: translateY(-2px);
}

ol {
    padding-left: 20px;
}

ol li {
    margin-bottom: 8px;
}

code {
    background: #f8f9fa;
    padding: 2px 6px;
    border-radius: 3px;
    font-family: monospace;
}
</style>
