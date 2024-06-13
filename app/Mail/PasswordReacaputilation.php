<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordReacaputilation extends Mailable
{
    use Queueable, SerializesModels;

    protected $id;
    protected $cin;
    protected $password;
    protected $created_at;

    /**
     * Create a new message instance.
     */
    public function __construct($id, $cin, $password, $created_at)
    {
        $this->id = $id;
        $this->cin = $cin;
        $this->password = $password;
        $this->created_at = $created_at;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Password recaputilation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content {
        $hashedChain = $this->id.''.$this->cin.''.$this->password.''.$this->created_at;
        $url = route('password.verify', ['hash' => base64_encode($this->id.'$$'.$this->cin.'$$'.$this->password.'$$'.$this->created_at)]);
        return (new Content())->view('mail.password')->with([ 'link' => $url, 'hash' => $hashedChain]);
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
