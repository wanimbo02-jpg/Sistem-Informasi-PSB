<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReplyMail;

class ContactController extends Controller
{
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

    /**
     * Display all contacts for admin
     */
    public function index()
    {
        $contacts = Contact::latest()->paginate(10);
        $unreadCount = Contact::unread()->count();
        
        return view('admin.contacts.index', compact('contacts', 'unreadCount'));
    }

    /**
     * Show contact detail
     */
    public function show(Contact $contact)
    {
        // Mark as read if unread
        if ($contact->status === 'unread') {
            $contact->markAsRead();
        }
        
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Reply to contact message
     */
    public function reply(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'reply' => 'required|string|min:5',
        ]);

        try {
            // Update contact with reply
            $contact->markAsReplied($validated['reply']);
            
            // Send email to user
            Mail::to($contact->email)->send(new ContactReplyMail($contact, $validated['reply']));
            
            return redirect()->route('admin.contacts.index')
                ->with('success', 'Balasan telah terkirim ke ' . $contact->email);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim balasan. Silakan coba lagi.');
        }
    }

    /**
     * Delete contact
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        
        return redirect()->route('admin.contacts.index')
            ->with('success', 'Pesan telah dihapus.');
    }

    /**
     * Mark multiple contacts as read
     */
    public function markAsReadMultiple(Request $request)
    {
        $contactIds = $request->input('contact_ids', []);
        
        if (!empty($contactIds)) {
            Contact::whereIn('id', $contactIds)->update(['status' => 'read']);
        }
        
        return back()->with('success', 'Pesan ditandai sebagai dibaca.');
    }

    /**
     * Delete multiple contacts
     */
    public function deleteMultiple(Request $request)
    {
        $contactIds = $request->input('contact_ids', []);
        
        if (!empty($contactIds)) {
            Contact::whereIn('id', $contactIds)->delete();
        }
        
        return back()->with('success', 'Pesan telah dihapus.');
    }

    /**
     * Get contact data for AJAX
     */
    public function getData(Contact $contact)
    {
        return response()->json([
            'id' => $contact->id,
            'name' => $contact->name,
            'email' => $contact->email,
            'phone' => $contact->phone,
            'company' => $contact->company,
            'message' => $contact->message,
            'status' => $contact->status,
            'created_at' => $contact->created_at->format('d M Y H:i'),
        ]);
    }
}
