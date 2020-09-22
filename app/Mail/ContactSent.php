<?php

namespace App\Mail;

use App\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactSent extends Mailable
{
    use Queueable, SerializesModels;
    public $contact;
    
    public function __construct(Contact $contact) {
        $this->contact = $contact;
    }
    public function build() {
        return $this->from($this->contact)
                    ->view('emails.contact.sent')->with(['title' => 'New Contact'])
                    ->text('emails.contact.sent_plain');
    }
}
