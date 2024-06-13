<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserVerification extends Mailable
{
    use Queueable, SerializesModels;

    protected $id;
    protected $created_at;
    protected $name;
    protected $prenom;
    protected $email;

    /**
     * Create a new message instance.
     */
    public function __construct($id, $created_at, $name, $prenom, $email)
    {
        $this->id = $id;
        $this->created_at = $created_at;
        $this->name = $name;
        $this->prenom = $prenom;
        $this->email = $email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'User Verification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content {
        $url = route('email_verification', ['hash' => base64_encode($this->created_at.'$$'.$this->id)]);
        return (new Content())->view('mail.mail_confirmation')->with(['email' => $this->email, 'name' => $this->name, 'prenom' => $this->prenom, 'link' => $url]);
    }
    

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachements( ) {
        return [];
  }

}
