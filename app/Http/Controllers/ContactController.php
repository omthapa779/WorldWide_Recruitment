<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
   public function send(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'email'   => 'required|email',
            'referal' => 'required|string',
            'message' => 'required|string',
        ]);

        Mail::to('omthapa781@email.com')->send(new ContactFormMail($data));

        return back()->with('success', 'Your message has been sent!');
    }
}