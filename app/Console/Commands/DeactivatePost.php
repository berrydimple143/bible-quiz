<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Post;
use App\User;

class DeactivatePost extends Command
{
    protected $signature = 'deactivate:post';
    protected $description = 'Mark all post or article as inactive if the owner or user is expired';
    
    public function __construct() {
        parent::__construct();
    }
    public function handle() {
        $posts = Post::all();
        foreach($posts as $p) {
            if($p->user->status == "inactive") {
                $p = Post::where('id', $p->id)->update(['status' => 'inactive']);
            }
        }
    }
}
