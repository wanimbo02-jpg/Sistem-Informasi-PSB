<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::latest()->paginate(10);
        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    public function create()
    {
        return view('admin.fasilitas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar'    => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        $gambarPath = $request->file('gambar')->store('fasilitas', 'public');

        Fasilitas::create([
            'nama'      => $request->nama,
            'deskripsi' => $request->deskripsi,
            'gambar'    => $gambarPath,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil ditambahkan!');
    }

    public function show(Fasilitas $fasilitas)
    {
        return view('admin.fasilitas.show', compact('fasilitas'));
    }

    public function edit(Fasilitas $fasilitas)
    {
        return view('admin.fasilitas.edit', compact('fasilitas'));
    }
    public function update(Request $request, Fasilitas $fasilitas)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = [
            'nama'      => $request->nama,
            'deskripsi' => $request->deskripsi,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('gambar')) {
            if ($fasilitas->gambar && Storage::disk('public')->exists($fasilitas->gambar)) {
                Storage::disk('public')->delete($fasilitas->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('fasilitas', 'public');
        }

        $fasilitas->update($data);

        return redirect()->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil diperbarui!');
    }

    public function destroy(Fasilitas $fasilitas)
    {
        if ($fasilitas->gambar && Storage::disk('public')->exists($fasilitas->gambar)) {
            Storage::disk('public')->delete($fasilitas->gambar);
        }
        $fasilitas->delete();

        return redirect()->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil dihapus!');
    }
}
