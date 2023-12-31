<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class ContactController extends Controller
{
    //
    public function index()
    {
        return Inertia::render('Contacts', []);
    }

    public function vueIndex()
    {
        $allContacts = Contact::orderBy('created_at', 'desc')
        ->get()
        ->transform(fn($contact) => [
            "id" => Crypt::encryptString($contact->id),
            "flname" => $contact->flname,
            "email" => $contact->email,
            "subject" => $contact->subject,
            "message" => $contact->message,
            "created_at" => $contact->created_at,
        ]);
        return Inertia::render('Admin/Contacts/Index', ["allContacts" => $allContacts]);
    }

    public function oneContact(Request $request)
    {
        try {
            $id = Crypt::decryptString($request->id);
            $oneContact = Contact::where("id", $id)
            ->get()
            ->transform(fn($contact) => [
                "id" => Crypt::encryptString($contact->id),
                "flname" => $contact->flname,
                "email" => $contact->email,
                "subject" => $contact->subject,
                "message" => $contact->message,
                "created_at" => $contact->created_at,
            ]);
            return json_encode(["result" => $oneContact[0]]);
        } catch (\Throwable $th) {
            return json_encode(["error" => $th]);
        }
    }

    // Récupération de tout les messages
    public function allContact()
    {
        $allContacts = Contact::orderBy('created_at', 'desc')
        ->get()
        ->transform(fn($contact) => [
            "id" => Crypt::encryptString($contact->id),
            "flname" => $contact->flname,
            "email" => $contact->email,
            "subject" => $contact->subject,
            "message" => $contact->message,
            "created_at" => $contact->created_at,
        ]);

        return json_encode($allContacts);
    }

    public function show($id)
    {
        // Logique pour afficher un élément spécifique
    }

    public function create()
    {
        // Logique pour afficher le formulaire de création
    }

    public function store(Request $request)
    {
        $flname = $request->formulaire["flname"];
        $email = $request->formulaire["email"];
        $subject = $request->formulaire["subject"];
        $msg = $request->formulaire["message"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return json_encode(["error" => "email_invalid"]);
        } else {
            try {
                Mail::send([], [], function ($message) use ($email, $subject, $msg) {
                    $message->from(env("MAIL_FROM_ADDRESS"));
                    $message->to($email);
                    $message->subject(($subject) ? $subject : "");
                    $message->text($msg);
                });

                Contact::create([
                    'flname' => $flname,
                    'email' => $email,
                    'subject' => $subject,
                    'message' => $msg,
                ]);
                return json_encode(["result" => "Message envoyé !!!"]);
            } catch (\Throwable $th) {
                return json_encode(["error" => "Une erreur est subvenue lors de l'envoi du message !!!"]);
            }
        }
    }

    public function edit($id)
    {
        // Logique pour afficher le formulaire d'édition
    }

    public function update(Request $request, $id)
    {
        // Logique pour traiter la mise à jour
    }

    public function destroy($id)
    {
        // Logique pour supprimer un élément
    }
}
