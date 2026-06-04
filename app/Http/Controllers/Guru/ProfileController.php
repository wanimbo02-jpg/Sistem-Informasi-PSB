<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        // Ambil semua user dengan role guru
        $gurus = User::where('role', 'guru')->orderBy('created_at', 'desc')->get();

        return view('guru.profile.index', compact('gurus'));
    }
}
