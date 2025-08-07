<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }
    public function giving()
    {
        return view('users.giving');
    }
    public function faq()
    {
        return view('users.faq');
    }
    public function about()
    {
        return view('users.about');
    }
    public function terms()
    {        return view('users.terms');
    }
    public function privacy()
    {        return view('users.privacy');
    }
    public function contact()
    {        return view('users.contact');
    }
    public function sendContact(Request $request)
    {
        // Handle contact form submission logic here
        // For example, validate the request and send an email
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);
        // Logic to send the contact message, e.g., using a mail service
        Log::info('Contact form submitted', [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
    public function winners()
    {
        return view('users.winners');
    }
    public function winnerDetails($id)
    {
        // Logic to fetch winner details by ID
        // $winner = Winner::findOrFail($id);
        return view('users.winnerDetails', compact('winner'));
    }
    public function rules()
    {
        return view('users.rules');
    }
}
