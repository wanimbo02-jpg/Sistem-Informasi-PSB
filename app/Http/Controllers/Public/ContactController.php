<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('public.contact', [
            'title' => 'Kontak Kami',
            'alamat' => 'Jl. Raya Karubaga No. 1, Karubaga',
            'telepon' => '(0961) 123456',
            'email' => 'info@smankarubaga.sch.id'
        ]);
    }

    /**
     * Store contact message from user
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        try {
            $contact = Contact::create($validated);
            
            return back()->with('success', 'Pesan Anda telah terkirim! Kami akan segera menghubungi Anda.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.');
        }
    }
}