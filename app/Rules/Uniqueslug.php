<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FunctionController;

class Uniqueslug implements Rule
{
    private $slug;
    public function __construct() {
        
    }
    public function passes($attribute, $value) {
        try {
            $slug = FunctionController::slugify($value);
            $this->slug = $slug;
            $p = Post::where('user_id', Auth::id())->where($attribute, $slug)->firstOrFail();
            return false;
        } catch (ModelNotFoundException $ex) {
            return true;
        }
    }
    public function message() {
        return "You've already created this :attribute '". $this->slug . "'. Please change it to something unique.";
    }
}
