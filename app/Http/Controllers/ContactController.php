<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    // Display all messages with pagination
    public function index()
{
    $messages = ContactMessage::latest()->paginate(8); // 1. Correct variable name, 2. Correct model name
    return view('admin.index', compact('messages'));    // 3. Correct compact usage
}

    // Store a new message from the contact form
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'phone'      => 'required|string|max:20',
            'subject'    => 'required|string|max:255',
            'message'    => 'required|string',
        ]);

        ContactMessage::create($validated);

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
