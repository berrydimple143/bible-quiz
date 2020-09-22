<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Post;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewsletterSubscribed extends Mailable
{
    use Queueable, SerializesModels;
    
    public function __construct() {
        
    }
    public function build() {
        $posts = Post::with('tagged')->withCount('comments')->where('id', '!=', null)->get();
        return $this->from('shekinahberry143@gmail.com')
                    ->view('emails.newsletter.subscribed')
                    ->with(['posts' => $posts, 'title' => 'Newsletter Email'])
                    ->text('emails.newsletter.subscribed_plain');
    }
}
