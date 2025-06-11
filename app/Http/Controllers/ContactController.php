<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // ✅ Validatie
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // ✅ Stuur mail (of logt het als je MAIL_MAILER=log gebruikt)
        Mail::raw($validated['message'], function ($message) use ($validated) {
            $message->to('jouw-email@voorbeeld.com') // vervang dit
                    ->subject('Nieuw contactbericht van ' . $validated['name'])
                    ->replyTo($validated['email']);
        });

        // ✅ Geef succes terug aan frontend
        return back()->with('success', true);
    }
}
