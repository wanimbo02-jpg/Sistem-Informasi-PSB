<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\DataPribadi;
use App\Models\DataOrangTua;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Ambil data pribadi
        $data_pribadi = DataPribadi::where('user_id', $user->id)->first();
        
        // Ambil data orang tua
        $data_ortu = DataOrangTua::where('user_id', $user->id)->first();
        
        // Hitung progress
        $progress = 0;
        if($data_pribadi) $progress += 1;
        if($data_ortu) $progress += 1;
        
        $data = [
            'user' => $user,
            'data_pribadi' => $data_pribadi,
            'data_ortu' => $data_ortu,
            'progress' => $progress,
            'progress_percent' => ($progress / 2) * 100
        ];
        
        return view('dashboard-siswa.index', $data);
    }
}