<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function sejarah()
    {
        return view('home.tentang.sejarah', [
            'title' => 'Sejarah SMA Negeri Karubaga'
        ]);
    }

    public function visiMisi()
    {
        return view('home.tentang.visi-misi', [
            'title' => 'Visi & Misi SMA Negeri Karubaga'
        ]);
    }

    public function struktur()
    {
        return view('home.tentang.struktur', [
            'title' => 'Struktur Organisasi SMA Negeri Karubaga'
        ]);
    }
}