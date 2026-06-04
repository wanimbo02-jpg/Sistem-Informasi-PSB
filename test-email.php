<?php

echo "<h1>Test Konfigurasi Email</h1>";

// Cek konfigurasi email saat ini
echo "<h2>Konfigurasi Email Saat Ini:</h2>";
echo "<ul>";
echo "<li><strong>MAIL_MAILER:</strong> " . config('mail.default') . "</li>";
echo "<li><strong>MAIL_HOST:</strong> " . config('mail.mailers.smtp.host') . "</li>";
echo "<li><strong>MAIL_PORT:</strong> " . config('mail.mailers.smtp.port') . "</li>";
echo "<li><strong>MAIL_USERNAME:</strong> " . config('mail.mailers.smtp.username') . "</li>";
echo "<li><strong>MAIL_ENCRYPTION:</strong> " . config('mail.mailers.smtp.encryption') . "</li>";
echo "<li><strong>MAIL_FROM_ADDRESS:</strong> " . config('mail.from.address') . "</li>";
echo "<li><strong>MAIL_FROM_NAME:</strong> " . config('mail.from.name') . "</li>";
echo "</ul>";

// Test kirim email
echo "<h2>Test Kirim Email:</h2>";

if (isset($_POST['test_email'])) {
    $email = $_POST['test_email'];
    
    try {
        // Load Laravel
        require __DIR__ . '/vendor/autoload.php';
        $app = require_once __DIR__ . '/bootstrap/app.php';
        $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
        $kernel->bootstrap();
        
        // Kirim test email
        Illuminate\Support\Facades\Mail::raw('Ini adalah test email dari sistem SMA Negeri Karubaga', function($message) use ($email) {
            $message->to($email)
                    ->subject('Test Email - SMA Negeri Karubaga')
                    ->from('noreply@smanegerikarubaga.sch.id', 'SMA Negeri Karubaga');
        });
        
        echo "<div class='alert alert-success'>✅ Email test berhasil dikirim ke: $email</div>";
        echo "<p>Silakan cek inbox/spam folder email Anda.</p>";
        
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>❌ Gagal mengirim email: " . $e->getMessage() . "</div>";
    }
} else {
    echo "<form method='post'>";
    echo "<div class='form-group'>";
    echo "<label>Email Test:</label>";
    echo "<input type='email' name='test_email' class='form-control' placeholder='masukkan@email.com' required>";
    echo "</div>";
    echo "<button type='submit' class='btn btn-primary'>Test Kirim Email</button>";
    echo "</form>";
}

echo "<h2>Solusi Quick Setup:</h2>";
echo "<h3>1. Gunakan Gmail SMTP:</h3>";
echo "<ol>";
echo "<li>Edit file .env</li>";
echo "<li>Ganti dengan konfigurasi berikut:</li>";
echo "</ol>";

echo "<pre style='background: #f5f5f5; padding: 15px; border-radius: 5px;'>";
echo "MAIL_MAILER=smtp\n";
echo "MAIL_HOST=smtp.gmail.com\n";
echo "MAIL_PORT=587\n";
echo "MAIL_USERNAME=your-email@gmail.com\n";
echo "MAIL_PASSWORD=your-app-password\n";
echo "MAIL_ENCRYPTION=tls\n";
echo "MAIL_FROM_ADDRESS=noreply@smanegerikarubaga.sch.id\n";
echo "MAIL_FROM_NAME=\"SMA Negeri Karubaga\"\n";
echo "</pre>";

echo "<h3>2. Cara Mendapatkan App Password Gmail:</h3>";
echo "<ol>";
echo "<li>Login ke Gmail</li>";
echo "<li>Go to: myaccount.google.com</li>";
echo "<li>Security → 2-Step Verification → Enable</li>";
echo "<li>App Passwords → Generate new</li>";
echo "<li>Select: Mail → Other → Generate</li>";
echo "<li>Copy 16-digit password</li>";
echo "<li>Gunakan di MAIL_PASSWORD</li>";
echo "</ol>";

echo "<h3>3. Setelah Setup:</h3>";
echo "<ul>";
echo "<li>Clear cache: php artisan config:clear</li>";
echo "<li>Restart server</li>";
echo "<li>Test register kembali</li>";
echo "</ul>";

?>
