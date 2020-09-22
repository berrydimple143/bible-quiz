<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Quizfile;

class DeleteQuizFile extends Command
{
    protected $signature = 'delele:quiz';
    protected $description = 'Deletes quiz files from public storage and database';

    public function __construct() {
        parent::__construct();
    }
    public function handle() {
        $qfiles = Quizfile::where('delete', 'yes')->get();
        if($qfiles->count() > 0) {
            foreach($qfiles as $fl) {
                $img = public_path('/uploads/files/'.$fl->filename);
                if(!unlink($img)) {
                    return 'error deleting.';
                } else {
                    $q = Quizfile::where('id', $fl->id)->delete();
                }  
            }
        }
    }
}
