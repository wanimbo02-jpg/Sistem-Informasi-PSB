<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataOrangTua;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $user->updateProgress();
        
        $dataOrangTua = $user->dataOrangTua;
        
        return view('dashboard', compact('user', 'dataOrangTua'));
    }

    public function storeDataPribadi(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string|size:10',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
        ]);

        $user = auth()->user();
        $user->update($request->all());
        $user->updateProgress();

        return redirect()->route('dashboard')->with('success', 'Data pribadi berhasil disimpan!');
    }

    public function storeDataOrangTua(Request $request)
    {
        $request->validate([
            'nik_ayah' => 'required|string|size:16',
            'nama_ayah' => 'required|string',
            'pekerjaan_ayah' => 'required|string',
            'pendidikan_ayah' => 'required|string',
            'no_hp_ayah' => 'required|string|max:15',
            'nik_ibu' => 'required|string|size:16',
            'nama_ibu' => 'required|string',
            'pekerjaan_ibu' => 'required|string',
            'pendidikan_ibu' => 'required|string',
            'no_hp_ibu' => 'required|string|max:15',
            'penghasilan_ortu' => 'required|string',
        ]);

        $user = auth()->user();
        
        DataOrangTua::updateOrCreate(
            ['user_id' => $user->id],
            $request->all()
        );

        $user->updateProgress();

        if ($user->progress_data == 100) {
            return redirect()->route('dashboard')->with('success', 'Selamat! Semua data telah lengkap. Data Anda akan segera diproses.');
        }

        return redirect()->route('dashboard')->with('success', 'Data orang tua berhasil disimpan!');
    }
}