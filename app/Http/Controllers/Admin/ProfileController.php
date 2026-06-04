<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua user dengan role admin
        $admins = User::where('role', 'admin')->orderBy('created_at', 'desc')->get();
        
        return view('admin.profile.index', compact('admins'));
    }
}
