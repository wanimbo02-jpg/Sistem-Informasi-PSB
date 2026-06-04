<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Untuk registrasi biasanya diizinkan tanpa autentikasi
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                'regex:/^[a-zA-Z\s\'.-]+$/', // hanya huruf, spasi, titik, apostrof, strip
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email', // pastikan email belum terdaftar
            ],
            'password' => [
                'required',
                'confirmed', // harus ada password_confirmation yang sama
                Password::defaults()
                    ->min(8)           // minimal 8 karakter
                    ->mixedCase()      // harus ada huruf besar & kecil
                    ->numbers()        // harus ada angka
                    ->symbols(),       // harus ada simbol (!@#$%^&*)
            ],
            'password_confirmation' => [
                'required',
            ],
            'role' => [
                'required',
                'string',
                'in:siswa,orangtua,panitia,admin',
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required'          => 'Nama lengkap wajib diisi.',
            'name.string'            => 'Nama harus berupa teks.',
            'name.min'               => 'Nama minimal harus 3 karakter.',
            'name.max'               => 'Nama maksimal 255 karakter.',
            'name.regex'             => 'Nama hanya boleh berisi huruf, spasi, titik, apostrof, atau tanda hubung.',

            'email.required'         => 'Email wajib diisi.',
            'email.email'            => 'Format email tidak valid.',
            'email.max'              => 'Email maksimal 255 karakter.',
            'email.unique'           => 'Email ini sudah terdaftar. Silakan gunakan email lain atau login.',

            'password.required'      => 'Password wajib diisi.',
            'password.min'           => 'Password minimal 8 karakter.',
            'password.mixed'         => 'Password harus mengandung huruf besar dan kecil.',
            'password.numbers'       => 'Password harus mengandung angka.',
            'password.symbols'       => 'Password harus mengandung simbol (contoh: !@#$%^&*).',
            'password.confirmed'     => 'Konfirmasi password tidak cocok.',

            'password_confirmation.required' => 'Konfirmasi password wajib diisi.',

            'role.required'          => 'Silakan pilih peran Anda terlebih dahulu.',
            'role.in'                => 'Peran yang dipilih tidak valid. Pilih salah satu dari: Siswa, Orang Tua/Wali, Panitia, atau Admin.',
        ];
    }

    /**
     * Get custom attributes for validator errors (opsional, membuat pesan lebih rapi).
     */
    public function attributes(): array
    {
        return [
            'name'                  => 'nama lengkap',
            'email'                 => 'alamat email',
            'password'              => 'kata sandi',
            'password_confirmation' => 'konfirmasi kata sandi',
            'role'                  => 'peran',
        ];
    }
}
