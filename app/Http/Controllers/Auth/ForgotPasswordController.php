<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Http\Controllers\FunctionController;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showLinkRequestForm() {
        return view('auth.passwords.email', [
            'title' => 'Reset Password', 
            'page' => 'Reset Password', 
            'othercategories' => FunctionController::getRandomCategories(7),
            'allcategories' => FunctionController::allCategories(),
            'categories' => FunctionController::getCategories(10),
            'bclass' => '404error_page'
        ]);
    }
}
