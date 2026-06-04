<?php

echo "<h1>🔧 Quick Fix Email Verification</h1>";

// Baca file .env
$envFile = '.env';
$envContent = file_get_contents($envFile);

echo "<h2>📊 Status Konfigurasi Email Saat Ini:</h2>";

// Cek konfigurasi saat ini
$mailMailer = strpos($envContent, 'MAIL_MAILER=') !== false ? 
             substr($envContent, strpos($envContent, 'MAIL_MAILER=') + 13, 10) : 'log';

$mailHost = strpos($envContent, 'MAIL_HOST=') !== false ? 
           substr($envContent, strpos($envContent, 'MAIL_HOST=') + 11, 20) : '127.0.0.1';

echo "<div class='status-card'>";
echo "<p><strong>MAIL_MAILER:</strong> <span class='badge " . ($mailMailer === 'smtp' ? 'bg-success' : 'bg-danger') . "'>$mailMailer</span></p>";
echo "<p><strong>MAIL_HOST:</strong> $mailHost</p>";

if ($mailMailer === 'log') {
    echo "<div class='alert alert-warning'>";
    echo "<strong>⚠️ Masalah Ditemukan!</strong><br>";
    echo "Email saat ini hanya disimpan di log, tidak dikirim ke email sungguhan.";
    echo "</div>";
}

echo "</div>";

// Setup otomatis Gmail SMTP
if (isset($_POST['fix_email'])) {
    $gmail = $_POST['gmail'];
    $password = $_POST['password'];
    
    // Update konfigurasi email
    $newEnvContent = $envContent;
    
    // Replace atau tambah konfigurasi email
    $replacements = [
        'MAIL_MAILER=log' => 'MAIL_MAILER=smtp',
        'MAIL_HOST=127.0.0.1' => 'MAIL_HOST=smtp.gmail.com',
        'MAIL_PORT=2525' => 'MAIL_PORT=587',
        'MAIL_USERNAME=null' => "MAIL_USERNAME=$gmail",
        'MAIL_PASSWORD=null' => "MAIL_PASSWORD=$password",
        'MAIL_ENCRYPTION=null' => 'MAIL_ENCRYPTION=tls',
        'MAIL_FROM_ADDRESS="hello@example.com"' => 'MAIL_FROM_ADDRESS=noreply@smanegerikarubaga.sch.id',
        'MAIL_FROM_NAME="${APP_NAME}"' => 'MAIL_FROM_NAME="SMA Negeri Karubaga"',
    ];
    
    foreach ($replacements as $old => $new) {
        $newEnvContent = str_replace($old, $new, $newEnvContent);
    }
    
    // Tambahkan encryption jika belum ada
    if (strpos($newEnvContent, 'MAIL_ENCRYPTION=') === false) {
        $newEnvContent .= "\nMAIL_ENCRYPTION=tls\n";
    }
    
    // Simpan file .env
    file_put_contents($envFile, $newEnvContent);
    
    echo "<div class='alert alert-success'>";
    echo "<h3>✅ Konfigurasi Email Berhasil Diperbaiki!</h3>";
    echo "<p><strong>Email:</strong> $gmail</p>";
    echo "<p><strong>Password:</strong> " . str_repeat('*', strlen($password)) . "</p>";
    echo "</div>";
    
    echo "<div class='alert alert-info'>";
    echo "<h4>🔄 Langkah Selanjutnya:</h4>";
    echo "<ol>";
    echo "<li>Buka terminal/command prompt</li>";
    echo "<li>Jalankan: <code>php artisan config:clear</code></li>";
    echo "<li>Restart server: <code>php artisan serve</code></li>";
    echo "<li>Coba register kembali</li>";
    echo "<li>Cek email Anda (inbox/spam)</li>";
    echo "</ol>";
    echo "</div>";
    
} else {
    echo "<div class='card'>";
    echo "<div class='card-header'>";
    echo "<h3>🚀 Setup Gmail SMTP (Quick Fix)</h3>";
    echo "</div>";
    echo "<div class='card-body'>";
    echo "<form method='post'>";
    
    echo "<div class='form-group'>";
    echo "<label for='gmail'>📧 Gmail Address:</label>";
    echo "<input type='email' id='gmail' name='gmail' class='form-control' placeholder='your-email@gmail.com' required>";
    echo "<small>Gunakan alamat Gmail yang akan mengirim email</small>";
    echo "</div>";
    
    echo "<div class='form-group'>";
    echo "<label for='password'>🔑 App Password:</label>";
    echo "<input type='password' id='password' name='password' class='form-control' placeholder='16-digit app password' required>";
    echo "<small>Bukan password Gmail biasa, tapi App Password</small>";
    echo "</div>";
    
    echo "<button type='submit' name='fix_email' class='btn btn-primary btn-lg'>🔧 Fix Email Configuration</button>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
    
    echo "<div class='card mt-4'>";
    echo "<div class='card-header'>";
    echo "<h3>📋 Cara Mendapatkan App Password Gmail:</h3>";
    echo "</div>";
    echo "<div class='card-body'>";
    echo "<ol>";
    echo "<li>📱 Buka <a href='https://myaccount.google.com' target='_blank'>Google Account</a></li>";
    echo "<li>🔐 Klik <strong>Security</strong></li>";
    echo "<li>📲 Scroll ke <strong>2-Step Verification</strong> (Enable jika belum)</li>";
    echo "<li>🔑 Klik <strong>App Passwords</strong></li>";
    echo "<li>➕ Klik <strong>Generate new</strong></li>";
    echo "<li>📧 Select app: <strong>Mail</strong></li>";
    echo "<li>💻 Select device: <strong>Other (Custom name)</strong></li>";
    echo "<li>✍️ Tulis nama: <strong>SMA Karubaga</strong></li>";
    echo "<li>📋 Copy 16-digit password yang muncul</li>";
    echo "<li>🚪 Tutup halaman (password hanya muncul sekali)</li>";
    echo "</ol>";
    echo "<div class='alert alert-warning'>";
    echo "<strong>⚠️ Penting:</strong> App Password berbeda dengan password Gmail biasa. Harus generate dari Google Account settings.";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}

// Test email setup
echo "<div class='card mt-4'>";
echo "<div class='card-header'>";
echo "<h3>🧪 Test Email Configuration</h3>";
echo "</div>";
echo "<div class='card-body'>";
echo "<p>Setelah setup, test konfigurasi email Anda:</p>";
echo "<a href='test-email.php' class='btn btn-info'>📧 Test Kirim Email</a>";
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

.btn-info {
    background: #17a2b8;
    color: white;
}

.btn-info:hover {
    background: #138496;
}

.btn-lg {
    padding: 16px 32px;
    font-size: 18px;
}

.alert {
    padding: 15px;
    border-radius: 6px;
    margin: 20px 0;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-warning {
    background: #fff3cd;
    color: #856404;
    border: 1px solid #ffeaa7;
}

.alert-info {
    background: #d1ecf1;
    color: #0c5460;
    border: 1px solid #bee5eb;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.badge {
    padding: 4px 8px;
    border-radius: 4px;
    color: white;
    font-size: 12px;
}

.bg-success {
    background: #28a745;
}

.bg-danger {
    background: #dc3545;
}

code {
    background: #f8f9fa;
    padding: 2px 6px;
    border-radius: 3px;
    font-family: monospace;
}

ol {
    padding-left: 20px;
}

ol li {
    margin-bottom: 8px;
}
</style>
