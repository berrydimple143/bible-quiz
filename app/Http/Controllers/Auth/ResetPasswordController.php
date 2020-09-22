<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Http\Controllers\FunctionController;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;
    protected $redirectTo = '/control';

    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showResetForm(Request $request, $token = null) {
        return view('auth.passwords.reset')->with([
            'token' => $token, 
            'email' => $request->email, 
            'title' => 'Change Password', 
            'page' => 'Change Password', 
            'othercategories' => FunctionController::getRandomCategories(7),
            'allcategories' => FunctionController::allCategories(),
            'categories' => FunctionController::getCategories(10),
            'bclass' => '404error_page'
        ]);
    }
}
