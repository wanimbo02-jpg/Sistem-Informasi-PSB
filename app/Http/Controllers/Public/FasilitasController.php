<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::where('is_active', true)->latest()->get();
        return view('public.berita', compact('fasilitas'));
    }
}
