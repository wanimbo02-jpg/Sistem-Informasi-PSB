<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Informasi;

class InformasiPendaftaranController extends Controller
{
    public function index()
    {
        $informasis = Informasi::statusAktif()
            ->orderBy('created_at', 'desc')
            ->paginate(6);
        
        // Debug: Tampilkan jumlah informasi
        // dd($informasis->count(), $informasis->toArray());
        
        // Debug tambahan
        if ($informasis->count() == 0) {
            // Cek semua informasi tanpa filter
            $allInformasi = Informasi::all();
            // dd('Total semua informasi: ' . $allInformasi->count(), $allInformasi->toArray());
        }
            
        return view('informasi-pendaftaran.index', compact('informasis'));
    }

    public function show($id)
    {
        $informasi = Informasi::statusAktif()
            ->where('id', $id)
            ->firstOrFail();
            
        return view('informasi-pendaftaran.show', compact('informasi'));
    }
}
