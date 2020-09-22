<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class IsAllowed
{
    public function handle($request, Closure $next) {
        $user = Auth::user();
        if($user->membership != "admin") {
            return redirect('/control');
        }
        return $next($request);
    }
}
