<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\EmailVerification;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

echo "=== TESTING EMAIL VERIFICATION SYSTEM ===\n\n";

// 1. Check email configuration
echo "1. Checking email configuration...\n";
echo "MAIL_MAILER: " . config('mail.mailer') . "\n";
echo "MAIL_HOST: " . config('mail.host') . "\n";
echo "MAIL_PORT: " . config('mail.port') . "\n";
echo "MAIL_USERNAME: " . config('mail.username') . "\n";
echo "MAIL_ENCRYPTION: " . config('mail.encryption') . "\n";
echo "MAIL_FROM_ADDRESS: " . config('mail.from.address') . "\n";
echo "MAIL_FROM_NAME: " . config('mail.from.name') . "\n\n";

// 2. Check if email_verifications table exists
echo "2. Checking email_verifications table...\n";
try {
    $count = \DB::table('email_verifications')->count();
    echo "✓ email_verifications table exists ({$count} records)\n\n";
} catch (\Exception $e) {
    echo "✗ email_verifications table error: " . $e->getMessage() . "\n\n";
}

// 3. Check if users table has email_verified_at column
echo "3. Checking users table email_verified_at column...\n";
try {
    $columns = \Schema::getColumnListing('users');
    if (in_array('email_verified_at', $columns)) {
        echo "✓ users table has email_verified_at column\n\n";
    } else {
        echo "✗ users table missing email_verified_at column\n\n";
    }
} catch (\Exception $e) {
    echo "✗ Error checking users table: " . $e->getMessage() . "\n\n";
}

// 4. Test creating verification code
echo "4. Testing verification code creation...\n";
try {
    $testEmail = 'test@example.com';
    $verification = EmailVerification::createForEmail($testEmail);
    echo "✓ Verification code created: {$verification->code}\n";
    echo "✓ Expires at: {$verification->expires_at}\n";
    echo "✓ Verified: " . ($verification->verified ? 'Yes' : 'No') . "\n\n";
} catch (\Exception $e) {
    echo "✗ Error creating verification: " . $e->getMessage() . "\n\n";
}

// 5. Test email sending
echo "5. Testing email sending...\n";
try {
    $testCode = '123456';
    $mail = new VerificationCodeMail($testCode);
    
    // Test email to the configured address
    $recipient = config('mail.from.address');
    echo "Sending test email to: {$recipient}\n";
    
    Mail::to($recipient)->send($mail);
    echo "✓ Test email sent successfully!\n\n";
} catch (\Exception $e) {
    echo "✗ Email sending failed: " . $e->getMessage() . "\n";
    echo "✗ Check your Gmail settings and App Password\n\n";
}

// 6. Check existing users without email verification
echo "6. Checking users without email verification...\n";
try {
    $usersWithoutVerification = User::whereNull('email_verified_at')
        ->where('role', 'siswa')
        ->limit(5)
        ->get();
    
    echo "Found {$usersWithoutVerification->count()} users without verification:\n";
    foreach ($usersWithoutVerification as $user) {
        echo "- {$user->name} ({$user->email})\n";
    }
    echo "\n";
} catch (\Exception $e) {
    echo "✗ Error checking users: " . $e->getMessage() . "\n\n";
}

// 7. Test complete flow
echo "7. Testing complete verification flow...\n";
try {
    // Create test user if not exists
    $testUser = User::firstOrCreate([
        'email' => 'teststudent@example.com'
    ], [
        'name' => 'Test Student',
        'nik' => '1234567890',
        'password' => bcrypt('password123'),
        'role' => 'siswa',
        'is_active' => 1
    ]);
    
    echo "✓ Test user created/exists: {$testUser->email}\n";
    
    // Create verification
    $verification = EmailVerification::createForEmail($testUser->email);
    echo "✓ Verification code: {$verification->code}\n";
    
    // Send email
    Mail::to($testUser->email)->send(new VerificationCodeMail($verification->code));
    echo "✓ Verification email sent to: {$testUser->email}\n";
    
    // Test verification
    $foundVerification = EmailVerification::findValid($testUser->email, $verification->code);
    if ($foundVerification) {
        echo "✓ Verification code is valid\n";
        
        // Mark as verified
        $foundVerification->markAsVerified();
        $testUser->email_verified_at = now();
        $testUser->save();
        echo "✓ User marked as verified\n";
    } else {
        echo "✗ Verification code not found or invalid\n";
    }
    
} catch (\Exception $e) {
    echo "✗ Complete flow error: " . $e->getMessage() . "\n\n";
}

echo "\n=== TESTING COMPLETE ===\n";
echo "If email sending failed, check:\n";
echo "1. Gmail App Password (not regular password)\n";
echo "2. Less secure apps enabled in Gmail\n";
echo "3. Correct email configuration in .env\n";
echo "4. Internet connection\n\n";

echo "Next steps:\n";
echo "1. Test registration from browser\n";
echo "2. Check email for verification code\n";
echo "3. Enter code in verification page\n";
echo "4. Verify login works after verification\n";
