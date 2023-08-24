<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'My Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }

    public function sendMail(Request $request)
    {
        $data = $request->validate([
            'to_email' => 'required',
            'content' => 'required',
        ]);
        
        $toEmail = $data['to_email'];
        $subject = $request->subject;
        $content = $data['content'];
        $emails = explode(" ", $toEmail);
        try {
            foreach ($emails as $email) {
                // Envoyer l'e-mail propostion 1
                // Mail::to($toEmail)->send(new EnvoiMail(env("MAIL_FROM_ADDRESS"), ($subject) ? $subject : "", $content));
                // Envoyer l'e-mail propostion 2
                Mail::send([], [], function ($message) use ($email, $subject, $content) {
                    $message->from(env("MAIL_FROM_ADDRESS"));
                    $message->to($email);
                    $message->subject(($subject) ? $subject : "");
                    $message->text($content);
                    // $message->fromPath($content);
                });
            }

        } catch (\Throwable $th) {
            // dd($th);
            throw $th;
        }

        return response()->json(['message' => 'E-mail envoyé']);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
