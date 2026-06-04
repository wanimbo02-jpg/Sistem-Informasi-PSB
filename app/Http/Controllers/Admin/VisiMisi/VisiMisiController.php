<?php

namespace App\Http\Controllers\Admin\VisiMisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VisiMisi;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visiMisi = VisiMisi::first();
        return view('admin.visi-misi.index', compact('visiMisi'));
    }

    public function create()
    {
        return view('admin.visi-misi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        VisiMisi::create($request->all());
        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Visi Misi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $visiMisi = VisiMisi::findOrFail($id);
        return view('admin.visi-misi.edit', compact('visiMisi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        $visiMisi = VisiMisi::findOrFail($id);
        $visiMisi->update($request->all());
        
        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Visi Misi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $visiMisi = VisiMisi::findOrFail($id);
        $visiMisi->delete();
        
        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Visi Misi berhasil dihapus');
    }
}
