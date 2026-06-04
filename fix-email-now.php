<?php

echo "<h1>🔧 PERBAIKI EMAIL VERIFIKASI SEKARANG</h1>";

// Baca dan perbaiki file .env
$envFile = '.env';
$envContent = file_get_contents($envFile);

echo "<div class='alert alert-danger'>";
echo "<h3>❌ MASALAH DITEMUKAN:</h3>";
echo "<p>Konfigurasi email saat ini:</p>";
echo "<ul>";
echo "<li>MAIL_MAILER=log (Email hanya disimpan di log, tidak dikirim)</li>";
echo "<li>MAIL_HOST=127.0.0.1 (Host lokal, tidak bisa kirim ke luar)</li>";
echo "<li>MAIL_USERNAME=null (Tidak ada email pengirim)</li>";
echo "<li>MAIL_PASSWORD=null (Tidak ada password)</li>";
echo "</ul>";
echo "</div>";

// Perbaiki konfigurasi
$newContent = $envContent;
$newContent = str_replace('MAIL_MAILER=log', 'MAIL_MAILER=smtp', $newContent);
$newContent = str_replace('MAIL_HOST=127.0.0.1', 'MAIL_HOST=smtp.gmail.com', $newContent);
$newContent = str_replace('MAIL_PORT=2525', 'MAIL_PORT=587', $newContent);
$newContent = str_replace('MAIL_USERNAME=null', 'MAIL_USERNAME=your-email@gmail.com', $newContent);
$newContent = str_replace('MAIL_PASSWORD=null', 'MAIL_PASSWORD=your-app-password', $newContent);
$newContent = str_replace('MAIL_FROM_ADDRESS="hello@example.com"', 'MAIL_FROM_ADDRESS=noreply@smanegerikarubaga.sch.id', $newContent);
$newContent = str_replace('MAIL_FROM_NAME="${APP_NAME}"', 'MAIL_FROM_NAME="SMA Negeri Karubaga"', $newContent);

// Tambahkan encryption jika belum ada
if (strpos($newContent, 'MAIL_ENCRYPTION=') === false) {
    $newContent .= "\nMAIL_ENCRYPTION=tls\n";
}

// Simpan file yang sudah diperbaiki
file_put_contents($envFile, $newContent);

echo "<div class='alert alert-success'>";
echo "<h3>✅ KONFIGURASI EMAIL DIPERBAIKI!</h3>";
echo "<p>Sekarang menggunakan SMTP Gmail untuk mengirim email.</p>";
echo "</div>";

if (isset($_POST['setup_email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Update dengan credentials user
    $finalContent = file_get_contents($envFile);
    $finalContent = str_replace('MAIL_USERNAME=your-email@gmail.com', "MAIL_USERNAME=$email", $finalContent);
    $finalContent = str_replace('MAIL_PASSWORD=your-app-password', "MAIL_PASSWORD=$password", $finalContent);
    
    file_put_contents($envFile, $finalContent);
    
    echo "<div class='alert alert-success'>";
    echo "<h3>🎉 SETUP EMAIL BERHASIL!</h3>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Status:</strong> Siap mengirim kode verifikasi</p>";
    echo "</div>";
    
    echo "<div class='alert alert-info'>";
    echo "<h4>🔄 LANGKAH TERAKHIR:</h4>";
    echo "<ol>";
    echo "<li>Buka terminal/command prompt</li>";
    echo "<li>Jalankan: <code>php artisan config:clear</code></li>";
    echo "<li>Restart server: <code>php artisan serve</code></li>";
    echo "<li>Register akun baru</li>";
    echo "<li>Cek email di HP Anda (inbox/spam)</li>";
    echo "<li>Masukkan kode verifikasi</li>";
    echo "</ol>";
    echo "</div>";
    
    echo "<div class='alert alert-warning'>";
    echo "<strong>⚠️ PENTING:</strong> Setelah clear cache dan restart server, kode verifikasi akan terkirim ke email HP Anda!";
    echo "</div>";
    
} else {
    echo "<div class='card'>";
    echo "<div class='card-header'>";
    echo "<h3>📧 SETUP GMAIL ANDA</h3>";
    echo "</div>";
    echo "<div class='card-body'>";
    echo "<form method='post'>";
    
    echo "<div class='form-group'>";
    echo "<label>📧 Email Gmail Anda:</label>";
    echo "<input type='email' name='email' class='form-control' placeholder='your-email@gmail.com' required>";
    echo "</div>";
    
    echo "<div class='form-group'>";
    echo "<label>🔑 App Password Gmail:</label>";
    echo "<input type='password' name='password' class='form-control' placeholder='16-digit app password' required>";
    echo "<small class='text-muted'>Bukan password Gmail biasa! Dapatkan dari Google Account settings</small>";
    echo "</div>";
    
    echo "<button type='submit' name='setup_email' class='btn btn-success btn-lg'>🚀 SETUP EMAIL SEKARANG</button>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
}

echo "<div class='card'>";
echo "<div class='card-header'>";
echo "<h3>📋 CARA DAPAT APP PASSWORD GMAIL:</h3>";
echo "</div>";
echo "<div class='card-body'>";
echo "<ol>";
echo "<li>📱 Buka <a href='https://myaccount.google.com' target='_blank'>Google Account</a> di HP Anda</li>";
echo "<li>🔐 Tap menu <strong>Security</strong></li>";
echo "<li>📲 Scroll ke <strong>2-Step Verification</strong></li>";
echo "<li>✅ Tap <strong>Enable</strong> jika belum aktif</li>";
echo "<li>🔑 Tap <strong>App Passwords</strong></li>";
echo "<li>➕ Tap <strong>Generate new</strong></li>";
echo "<li>📧 Select app: <strong>Mail</strong></li>";
echo "<li>💻 Select device: <strong>Other (Custom name)</strong></li>";
echo "<li>✍️ Tulis nama: <strong>SMA Karubaga</strong></li>";
echo "<li>📋 Copy 16-digit password yang muncul</li>";
echo "<li>🚀 Kembali ke halaman ini dan masukkan password</li>";
echo "</ol>";
echo "</div>";
echo "</div>";

echo "<div class='alert alert-success'>";
echo "<h3>✅ HASIL SETELAH SETUP:</h3>";
echo "<ul>";
echo "<li>📧 Kode verifikasi akan terkirim ke email HP Anda</li>";
echo "<li>📱 Cek inbox Gmail di HP Anda</li>";
echo "<li>🔍 Juga cek folder spam jika tidak ada di inbox</li>";
echo "<li>⏱️ Kode berlaku 15 menit</li>";
echo "<li>🔑 Masukkan 6 digit kode untuk verifikasi</li>";
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

.btn-success {
    background: #28a745;
    color: white;
}

.btn-success:hover {
    background: #218838;
    transform: translateY(-2px);
}

.btn-lg {
    padding: 16px 32px;
    font-size: 18px;
}

ol {
    padding-left: 20px;
}

ol li {
    margin-bottom: 10px;
}

code {
    background: #f8f9fa;
    padding: 2px 6px;
    border-radius: 3px;
    font-family: monospace;
}
</style>
