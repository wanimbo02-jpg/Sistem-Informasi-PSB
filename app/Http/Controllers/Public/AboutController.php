<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VisiMisi;

class AboutController extends Controller
{
    public function index()
    {
        return view('public.about', [
            'title' => 'Tentang Sekolah'
        ]);
    }

    public function sejarah()
    {
        return view('home.tentang.sejarah', [
            'title' => 'Sejarah Sekolah'
        ]);
    }

    public function visiMisi()
    {
        $visiMisi = VisiMisi::first();
        return view('home.tentang.visi-misi', [
            'title' => 'Visi & Misi',
            'visiMisi' => $visiMisi
        ]);
    }

    public function struktur()
    {
        $strukturs = \App\Models\StrukturOrganisasi::orderBy('urutan')->get();
        return view('home.tentang.struktur', [
            'title'     => 'Struktur Organisasi',
            'strukturs' => $strukturs,
        ]);
    }
}