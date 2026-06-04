<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    // Middleware sudah dihandle oleh route group

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::latest()->paginate(10);
        return view('admin.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_date' => 'required|date',
            'event_category' => 'required|string|max:100',
            'location' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $image = $request->file('image');
        $imagePath = $image->store('galleries', 'public');

        $gallery = Gallery::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'description' => $request->description,
            'image' => $imagePath,
            'event_date' => $request->event_date,
            'event_category' => $request->event_category,
            'location' => $request->location,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        return view('admin.gallery.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_date' => 'required|date',
            'event_category' => 'required|string|max:100',
            'location' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'description' => $request->description,
            'event_date' => $request->event_date,
            'event_category' => $request->event_category,
            'location' => $request->location,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }
            
            // Upload gambar baru
            $image = $request->file('image');
            $data['image'] = $image->store('galleries', 'public');
        }

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        // Hapus gambar
        if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery berhasil dihapus!');
    }
}
