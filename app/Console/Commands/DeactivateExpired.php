<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\User;
use Carbon\Carbon;

class DeactivateExpired extends Command
{
    protected $signature = 'deactivate:expired';
    protected $description = 'Mark the expired users as inactive';
    
    public function __construct() {
        parent::__construct();
    }
    public function handle() {
        $now = Carbon::now();
        $users = User::all();
        foreach($users as $usr) {
            if($usr->membership != "admin") {
                $exp = new Carbon($usr->expired_at);
                if($now > $exp) {
                    $p = User::where('id', $usr->id)->update(['status' => 'inactive']);
                }
            }
        }
    }
}
