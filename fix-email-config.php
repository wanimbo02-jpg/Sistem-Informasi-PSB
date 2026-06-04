<?php

// Script untuk memperbaiki konfigurasi email agar verifikasi terkirim

echo "<h1>🔧 Perbaiki Konfigurasi Email</h1>";

// Baca file .env
$envContent = file_get_contents('.env');

echo "<h2>Status Konfigurasi Saat Ini:</h2>";

// Cek apakah menggunakan log
if (strpos($envContent, 'MAIL_MAILER=log') !== false) {
    echo "<div class='alert alert-danger'>";
    echo "❌ <strong>PROBLEM:</strong> Email saat ini hanya disimpan di log file, tidak dikirim!";
    echo "</div>";
    
    // Fix konfigurasi
    $newContent = str_replace('MAIL_MAILER=log', 'MAIL_MAILER=smtp', $envContent);
    $newContent = str_replace('MAIL_HOST=127.0.0.1', 'MAIL_HOST=smtp.gmail.com', $newContent);
    $newContent = str_replace('MAIL_PORT=2525', 'MAIL_PORT=587', $newContent);
    $newContent = str_replace('MAIL_ENCRYPTION=null', 'MAIL_ENCRYPTION=tls', $newContent);
    
    // Update username dan password dengan placeholder
    $newContent = str_replace('MAIL_USERNAME=null', 'MAIL_USERNAME=your-email@gmail.com', $newContent);
    $newContent = str_replace('MAIL_PASSWORD=null', 'MAIL_PASSWORD=your-app-password', $newContent);
    
    // Update from address
    $newContent = str_replace('MAIL_FROM_ADDRESS="hello@example.com"', 'MAIL_FROM_ADDRESS=noreply@smanegerikarubaga.sch.id', $newContent);
    $newContent = str_replace('MAIL_FROM_NAME="${APP_NAME}"', 'MAIL_FROM_NAME="SMA Negeri Karubaga"', $newContent);
    
    // Simpan file .env yang sudah diperbaiki
    file_put_contents('.env', $newContent);
    
    echo "<div class='alert alert-success'>";
    echo "✅ <strong>Konfigurasi Email Diperbaiki!</strong><br>";
    echo "Sekarang menggunakan SMTP Gmail untuk mengirim email.<br>";
    echo "Tapi Anda perlu mengupdate email dan password Gmail.";
    echo "</div>";
    
    echo "<h3>📋 Langkah Selanjutnya:</h3>";
    echo "<div class='steps'>";
    echo "<h4>1. Edit File .env:</h4>";
    echo "<p>Buka file .env dan ganti:</p>";
    echo "<pre>";
    echo "MAIL_USERNAME=your-email@gmail.com    → Ganti dengan email Gmail Anda";
    echo "MAIL_PASSWORD=your-app-password      → Ganti dengan App Password Gmail";
    echo "</pre>";
    
    echo "<h4>2. Cara Dapat App Password Gmail:</h4>";
    echo "<ol>";
    echo "<li>Login ke <a href='https://myaccount.google.com' target='_blank'>Google Account</a></li>";
    echo "<li>Klik <strong>Security</strong></li>";
    echo "<li>Scroll ke <strong>2-Step Verification</strong> (Enable jika belum)</li>";
    echo "<li>Klik <strong>App Passwords</strong></li>";
    echo "<li>Generate new → Select: Mail → Other → Generate</li>";
    echo "<li>Copy 16-digit password</li>";
    echo "</ol>";
    
    echo "<h4>3. Clear Cache:</h4>";
    echo "<p>Jalankan di terminal:</p>";
    echo "<pre>php artisan config:clear</pre>";
    
    echo "<h4>4. Restart Server:</h4>";
    echo "<pre>php artisan serve</pre>";
    
    echo "<h4>5. Test Register:</h4>";
    echo "<ol>";
    echo "<li>Register akun baru</li>";
    echo "<li>Cek email Anda (inbox/spam folder)</li>";
    echo "<li>Masukkan kode verifikasi</li>";
    echo "<li>Login berhasil</li>";
    echo "</ol>";
    echo "</div>";
    
} else {
    echo "<div class='alert alert-info'>";
    echo "✅ Konfigurasi email sudah menggunakan SMTP";
    echo "</div>";
}

// Test koneksi email
echo "<h2>🧪 Test Kirim Email:</h2>";
echo "<p>Setelah setup, test kirim email:</p>";
echo "<a href='test-email.php' class='btn btn-primary'>Test Kirim Email</a>";

echo "<h2>📝 Contoh Konfigurasi .env yang Benar:</h2>";
echo "<pre style='background: #f5f5f5; padding: 15px; border-radius: 5px;'>";
echo "MAIL_MAILER=smtp";
echo "MAIL_HOST=smtp.gmail.com";
echo "MAIL_PORT=587";
echo "MAIL_USERNAME=your-email@gmail.com";
echo "MAIL_PASSWORD=your-16-digit-app-password";
echo "MAIL_ENCRYPTION=tls";
echo "MAIL_FROM_ADDRESS=noreply@smanegerikarubaga.sch.id";
echo "MAIL_FROM_NAME=\"SMA Negeri Karubaga\"";
echo "</pre>";

echo "<div class='alert alert-warning'>";
echo "<strong>⚠️ Penting:</strong> Gunakan App Password Gmail, bukan password Gmail biasa!";
echo "</div>";

?>

<style>
body {
    font-family: Arial, sans-serif;
    max-width: 900px;
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

.steps {
    background: white;
    padding: 20px;
    border-radius: 8px;
    margin: 20px 0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.steps h4 {
    color: #007bff;
    margin-top: 20px;
    margin-bottom: 10px;
}

.steps h4:first-child {
    margin-top: 0;
}

pre {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 5px;
    overflow-x: auto;
    border: 1px solid #e9ecef;
}

ol {
    padding-left: 20px;
}

ol li {
    margin-bottom: 8px;
}

.btn {
    display: inline-block;
    padding: 12px 24px;
    background: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-weight: bold;
    transition: all 0.3s ease;
}

.btn:hover {
    background: #0056b3;
    transform: translateY(-2px);
}

h1, h2, h3 {
    color: #333;
}
</style>
