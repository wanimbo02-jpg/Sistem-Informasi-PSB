<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::where('is_active', true)
            ->latest('event_date')
            ->paginate(12);
            
        return view('public.gallery.index', compact('galleries'));
    }

    public function show($slug)
    {
        $gallery = Gallery::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
            
        // Increment views
        $gallery->incrementViews();
        
        // Get related galleries - semua gallery akan memiliki related galleries
        $relatedGalleries = Gallery::where('is_active', true)
            ->where('id', '!=', $gallery->id)
            ->latest('event_date')
            ->take(4)
            ->get();
            
        return view('public.gallery.show', compact('gallery', 'relatedGalleries'));
    }
}
