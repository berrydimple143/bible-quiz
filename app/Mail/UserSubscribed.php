<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class UserSubscribed extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    
    public function __construct(User $user) {
        $this->user = $user;
    }
    public function build() {
        return $this->from('dimplevirgil@gmail.com')
                    ->view('emails.users.subscribed')
                    ->text('emails.users.subscribed_plain');
    }
}
