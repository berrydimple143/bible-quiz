<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\User;
use Hash;

class HasPassword implements Rule
{
    public function __construct() {
        
    }
    public function passes($attribute, $value) {
        $user = User::where('id', Auth::id())->first();
        if(Hash::check($value, $user->password)) {
            return true;
        } else {
            return false;
        }
    }
    public function message() {
        return "Your old password is incorrect.";
    }
}
