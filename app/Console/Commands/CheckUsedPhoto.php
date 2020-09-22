<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Http\Controllers\FunctionController;
use App\Post;
use App\Photo;

class CheckUsedPhoto extends Command
{
    protected $signature = 'used:photo';
    protected $description = 'Check for the used images and update the photo database';
    
    public function __construct() {
        parent::__construct();
    }
    public function handle() {
        $images = FunctionController::getImages();
        $posts = Post::all();
        foreach($posts as $pst) {
            foreach($images as $im) {
                if(array_key_exists($pst->id, $im)) {
                    $fname = $im[$pst->id];
                    $p = Photo::where('filename', $fname)->update(['selected' => 'yes']);
                }
            }
        }
    }
}
