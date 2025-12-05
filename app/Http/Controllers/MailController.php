<?php

namespace App\Http\Controllers;
use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function showForm()
    {
        return view('emails.form');
    }

    public function sendMail(Request $request)
    {
        //Validation des champs du formulaire
        $request->validate([
            'email' => 'required|email',
            'message' => 'required|string',
            'attachment' => 'nullable|file|max:2048', // Taille max 2MB pour l'attachment
        ]);

        // Recupération du contenu du message et l'attachment(s'il existe)
        $messageContent = $request->message;
        $attachment = $request->file('attachment');

        // Envoi du mail avec la class TestMail
        Mail::to($request->email)->send(new TestMail($messageContent, $attachment));

        // On retourne un message de succès
        return back()->with('success', 'Email envoyé avec succès');

    }

}
