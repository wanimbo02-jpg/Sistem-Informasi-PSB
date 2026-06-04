<?php

echo "<h1>🚀 Setup Email Verification - Quick Fix</h1>";

// Auto fix konfigurasi email
$envFile = '.env';
$envContent = file_get_contents($envFile);

// Check current configuration
if (strpos($envContent, 'MAIL_MAILER=log') !== false) {
    echo "<div class='alert alert-danger'>";
    echo "❌ <strong>Masalah:</strong> Email hanya disimpan di log, tidak dikirim!";
    echo "</div>";
    
    // Auto fix
    $newContent = $envContent;
    $newContent = str_replace('MAIL_MAILER=log', 'MAIL_MAILER=smtp', $newContent);
    $newContent = str_replace('MAIL_HOST=127.0.0.1', 'MAIL_HOST=smtp.gmail.com', $newContent);
    $newContent = str_replace('MAIL_PORT=2525', 'MAIL_PORT=587', $newContent);
    $newContent = str_replace('MAIL_ENCRYPTION=null', 'MAIL_ENCRYPTION=tls', $newContent);
    $newContent = str_replace('MAIL_USERNAME=null', 'MAIL_USERNAME=your-email@gmail.com', $newContent);
    $newContent = str_replace('MAIL_PASSWORD=null', 'MAIL_PASSWORD=your-app-password', $newContent);
    $newContent = str_replace('MAIL_FROM_ADDRESS="hello@example.com"', 'MAIL_FROM_ADDRESS=noreply@smanegerikarubaga.sch.id', $newContent);
    
    file_put_contents($envFile, $newContent);
    
    echo "<div class='alert alert-success'>";
    echo "✅ <strong>Auto Fix Berhasil!</strong> Konfigurasi email sudah diperbaiki.";
    echo "</div>";
}

echo "<div class='card'>";
echo "<div class='card-header'>";
echo "<h3>📧 Setup Gmail untuk Kirim Kode Verifikasi</h3>";
echo "</div>";
echo "<div class='card-body'>";

if (isset($_POST['setup_gmail'])) {
    $email = $_POST['gmail'];
    $password = $_POST['password'];
    
    // Update .env dengan credentials user
    $currentEnv = file_get_contents($envFile);
    $currentEnv = str_replace('MAIL_USERNAME=your-email@gmail.com', "MAIL_USERNAME=$email", $currentEnv);
    $currentEnv = str_replace('MAIL_PASSWORD=your-app-password', "MAIL_PASSWORD=$password", $currentEnv);
    
    file_put_contents($envFile, $currentEnv);
    
    echo "<div class='alert alert-success'>";
    echo "<h4>✅ Setup Gmail Berhasil!</h4>";
    echo "<p>Email: <strong>$email</strong></p>";
    echo "<p>Status: Konfigurasi disimpan</p>";
    echo "</div>";
    
    echo "<div class='alert alert-info'>";
    echo "<h4>🔄 Langkah Terakhir:</h4>";
    echo "<ol>";
    echo "<li>Buka terminal</li>";
    echo "<li>Jalankan: <code>php artisan config:clear</code></li>";
    echo "<li>Restart server: <code>php artisan serve</code></li>";
    echo "<li>Test register kembali</li>";
    echo "<li>Cek email untuk kode verifikasi</li>";
    echo "</ol>";
    echo "</div>";
    
} else {
    echo "<form method='post'>";
    echo "<div class='form-group'>";
    echo "<label>📧 Gmail Anda:</label>";
    echo "<input type='email' name='gmail' class='form-control' placeholder='your-email@gmail.com' required>";
    echo "</div>";
    
    echo "<div class='form-group'>";
    echo "<label>🔑 App Password Gmail:</label>";
    echo "<input type='password' name='password' class='form-control' placeholder='16-digit app password' required>";
    echo "<small>Bukan password Gmail biasa! Dapatkan dari Google Account settings</small>";
    echo "</div>";
    
    echo "<button type='submit' class='btn btn-primary btn-lg'>🚀 Setup Gmail Sekarang</button>";
    echo "</form>";
}

echo "</div>";
echo "</div>";

echo "<div class='card'>";
echo "<div class='card-header'>";
echo "<h3>📋 Cara Dapat App Password Gmail:</h3>";
echo "</div>";
echo "<div class='card-body'>";
echo "<ol>";
echo "<li>📱 Buka <a href='https://myaccount.google.com' target='_blank'>Google Account</a></li>";
echo "<li>🔐 Klik <strong>Security</strong> di menu kiri</li>";
echo "<li>📲 Scroll ke <strong>2-Step Verification</strong></li>";
echo "<li>✅ Enable jika belum aktif</li>";
echo "<li>🔑 Klik <strong>App Passwords</strong></li>";
echo "<li>➕ Klik <strong>Generate new</strong></li>";
echo "<li>📧 Select app: <strong>Mail</strong></li>";
echo "<li>💻 Select device: <strong>Other (Custom name)</strong></li>";
echo "<li>✍️ Tulis nama: <strong>SMA Karubaga</strong></li>";
echo "<li>📋 Copy 16-digit password yang muncul</li>";
echo "<li>🚀 Gunakan password tersebut di form atas</li>";
echo "</ol>";
echo "</div>";
echo "</div>";

echo "<div class='alert alert-warning'>";
echo "<strong>⚠️ Penting:</strong> Setelah setup, kode verifikasi akan dikirim ke email Anda saat register!";
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

.btn-lg {
    padding: 16px 32px;
    font-size: 18px;
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
