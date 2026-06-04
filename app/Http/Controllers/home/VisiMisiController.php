<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visiMisi = VisiMisi::first();
        return view('Home.tentang.visi-misi', compact('visiMisi'));
    }
}
