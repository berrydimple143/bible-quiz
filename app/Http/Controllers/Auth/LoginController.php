<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\FunctionController;
use App\Subscription;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/control';
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    protected function showLoginForm() {
        $reg = Subscription::where('name', 'regular')->first();
        return FunctionController::viewFrontPage('auth.login', '', 'Login Page', 'Login Page', 'shop_grid_page', $reg, '');
    }
}
