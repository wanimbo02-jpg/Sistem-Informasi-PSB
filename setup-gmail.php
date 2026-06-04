<?php

echo "<h1>Setup Gmail SMTP Otomatis</h1>";

if (isset($_POST['setup_gmail'])) {
    $email = $_POST['gmail_address'];
    $password = $_POST['app_password'];
    
    // Baca file .env
    $envContent = file_get_contents('.env');
    
    // Update konfigurasi email
    $replacements = [
        'MAIL_MAILER=log' => 'MAIL_MAILER=smtp',
        'MAIL_HOST=127.0.0.1' => 'MAIL_HOST=smtp.gmail.com',
        'MAIL_PORT=2525' => 'MAIL_PORT=587',
        'MAIL_USERNAME=null' => "MAIL_USERNAME=$email",
        'MAIL_PASSWORD=null' => "MAIL_PASSWORD=$password",
        'MAIL_ENCRYPTION=null' => 'MAIL_ENCRYPTION=tls',
        'MAIL_FROM_ADDRESS="hello@example.com"' => 'MAIL_FROM_ADDRESS=noreply@smanegerikarubaga.sch.id',
        'MAIL_FROM_NAME="${APP_NAME}"' => 'MAIL_FROM_NAME="SMA Negeri Karubaga"',
    ];
    
    $newContent = $envContent;
    foreach ($replacements as $old => $new) {
        $newContent = str_replace($old, $new, $newContent);
    }
    
    // Tambahkan konfigurasi jika belum ada
    if (strpos($newContent, 'MAIL_ENCRYPTION=') === false) {
        $newContent .= "\nMAIL_ENCRYPTION=tls\n";
    }
    
    // Simpan file .env
    file_put_contents('.env', $newContent);
    
    echo "<div class='alert alert-success'>";
    echo "<h3>✅ Konfigurasi Gmail SMTP Berhasil!</h3>";
    echo "<p>Email: $email</p>";
    echo "<p>Password: " . str_repeat('*', strlen($password)) . "</p>";
    echo "</div>";
    
    echo "<h3>Langkah Selanjutnya:</h3>";
    echo "<ol>";
    echo "<li>Clear cache: php artisan config:clear</li>";
    echo "<li>Restart server: php artisan serve</li>";
    echo "<li>Test register kembali</li>";
    echo "</ol>";
    
    echo "<p><a href='test-email.php' class='btn btn-primary'>Test Email Configuration</a></p>";
    
} else {
    echo "<div class='card'>";
    echo "<div class='card-header'>";
    echo "<h3>Setup Gmail SMTP Configuration</h3>";
    echo "</div>";
    echo "<div class='card-body'>";
    echo "<form method='post'>";
    echo "<div class='form-group mb-3'>";
    echo "<label for='gmail_address'>Gmail Address:</label>";
    echo "<input type='email' id='gmail_address' name='gmail_address' class='form-control' placeholder='your-email@gmail.com' required>";
    echo "<small class='form-text text-muted'>Gunakan alamat Gmail Anda</small>";
    echo "</div>";
    
    echo "<div class='form-group mb-3'>";
    echo "<label for='app_password'>App Password:</label>";
    echo "<input type='password' id='app_password' name='app_password' class='form-control' placeholder='16-digit app password' required>";
    echo "<small class='form-text text-muted'>Gunakan App Password, bukan password Gmail biasa</small>";
    echo "</div>";
    
    echo "<button type='submit' name='setup_gmail' class='btn btn-primary'>Setup Gmail SMTP</button>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
    
    echo "<div class='alert alert-info mt-4'>";
    echo "<h4>📋 Cara Mendapatkan App Password Gmail:</h4>";
    echo "<ol>";
    echo "<li>Buka <a href='https://myaccount.google.com' target='_blank'>Google Account</a></li>";
    echo "<li>Security → 2-Step Verification (Enable jika belum)</li>";
    echo "<li>App Passwords → Generate new</li>";
    echo "<li>Select app: Mail</li>";
    echo "<li>Select device: Other (Custom name)</li>";
    echo "<li>Generate → Copy 16-digit password</li>";
    echo "<li>Gunakan password tersebut di form ini</li>";
    echo "</ol>";
    echo "</div>";
}

?>

<style>
.card {
    border: 1px solid #ddd;
    border-radius: 8px;
    margin: 20px 0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
.card-header {
    background: #007bff;
    color: white;
    padding: 15px;
}
.card-body {
    padding: 20px;
}
.form-group {
    margin-bottom: 15px;
}
.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}
.btn {
    background: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
.btn:hover {
    background: #0056b3;
}
.alert {
    padding: 15px;
    border-radius: 4px;
    margin: 15px 0;
}
.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}
.alert-info {
    background: #d1ecf1;
    color: #0c5460;
    border: 1px solid #bee5eb;
}
</style>
