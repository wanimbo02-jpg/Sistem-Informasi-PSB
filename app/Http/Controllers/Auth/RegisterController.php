<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\VerificationCodeMail;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Debug: lihat data yang masuk
        \Log::info('Register data:', $request->all());
        
        // Validasi untuk registrasi siswa (hanya NISN 10 digit)
        $nisn = $request->input('username');
        $validationRules = [
            'username' => 'required|string|size:10|unique:users,nik', // Hanya NISN 10 digit
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
        ];

        // Validasi khusus NISN 10 digit untuk siswa
        if (strlen($nisn) !== 10) {
            return back()->withErrors(['username' => 'silahkan masukkan nisn anda dengan benar'])->withInput();
        }
        
        $validator = Validator::make($request->all(), $validationRules, [
            'username.size' => 'silahkan masukkan nisn anda dengan benar',
            'username.unique' => 'silahkan masukkan nisn anda dengan benar',
            'username.required' => 'silahkan masukkan nisn anda dengan benar',
            'email.required' => 'silahkan masukkan nisn anda dengan benar',
            'email.email' => 'silahkan masukkan nisn anda dengan benar',
            'email.unique' => 'silahkan masukkan nisn anda dengan benar',
            'password.required' => 'silahkan masukkan nisn anda dengan benar',
            'password.confirmed' => 'silahkan masukkan nisn anda dengan benar',
            'name.required' => 'silahkan masukkan nisn anda dengan benar',
            'name.max' => 'silahkan masukkan nisn anda dengan benar',
            'email.max' => 'silahkan masukkan nisn anda dengan benar',
        ]);

        if ($validator->fails()) {
            \Log::error('Validation failed: ' . json_encode($validator->errors()->toArray()));
            return back()->withErrors($validator)->withInput();
        }

        try {
            // Debug: Log semua data request
            \Log::info('All request data: ' . json_encode($request->all()));
            \Log::info('NISN yang akan disimpan: ' . $request->username . ' (panjang: ' . strlen($request->username) . ')');
            \Log::info('Password yang akan disimpan: ' . $request->password . ' (panjang: ' . strlen($request->password) . ')');
            
            // Buat user baru menggunakan method create
            $user = $this->create($request->all());
            
            // Debug: Log nilai yang tersimpan
            \Log::info('NISN yang tersimpan di database: ' . $user->nik . ' (panjang: ' . strlen($user->nik) . ')');
            \Log::info('Password yang tersimpan di database: ' . $user->password . ' (panjang: ' . strlen($user->password) . ')');
            \Log::info('Password exists in database: ' . (!empty($user->password) ? 'YES' : 'NO'));

            // Create verification code and send email
            $verification = EmailVerification::createForEmail($user->email);
            
            // Store email in session for verification
            Session::put('verification_email', $user->email);
            
            // Flash session success message
            Session::flash('success', 'Registrasi berhasil! Kode verifikasi telah dikirim ke email Anda.');

            try {
                Mail::to($user->email)->send(new VerificationCodeMail($verification->code));
                
                // Selalu arahkan ke halaman verifikasi sebelum login
                return redirect()->route('verify.before.login');
                    
            } catch (\Exception $e) {
                \Log::error('Email sending failed: ' . $e->getMessage());
                
                // Selalu arahkan ke halaman verifikasi sebelum login, tidak peduli environment
                return redirect()->route('verify.before.login')
                    ->with('error', 'Gagal mengirim email. Silakan coba kirim ulang kode verifikasi.')
                    ->with('warning', 'Registrasi berhasil! Kode verifikasi telah dibuat. Gunakan tombol kirim ulang untuk menerima kode.');
            }
                
        } catch (\Exception $e) {
            \Log::error('Registration error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'silahkan masukkan nisn anda dengan benar'])->withInput();
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Debug: Log semua data
        \Log::info('Creating user with data: ' . json_encode($data));
        
        // Password disimpan apa adanya tanpa hash
        $plainPassword = $data['password'];
        \Log::info('Password to save: ' . $plainPassword);
        
        // Create user dengan password asli
        $user = new User();
        $user->nik = $data['username'];
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $plainPassword; // Password asli tanpa hash
        $user->role = 'siswa';
        $user->is_active = true;
        
        \Log::info('User object before save: ' . json_encode([
            'nik' => $user->nik,
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'role' => $user->role,
            'is_active' => $user->is_active
        ]));
        
        $user->save();
        
        \Log::info('User saved with ID: ' . $user->id);
        
        // Verifikasi dari database
        $dbUser = User::find($user->id);
        \Log::info('User from database:', [
            'id' => $dbUser->id,
            'nik' => $dbUser->nik,
            'name' => $dbUser->name,
            'email' => $dbUser->email,
            'password' => $dbUser->password,
            'password_length' => strlen($dbUser->password),
            'role' => $dbUser->role,
            'is_active' => $dbUser->is_active
        ]);
        
        return $user;
    }
}