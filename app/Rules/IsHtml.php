<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsHtml implements Rule
{
    public function __construct() {
        
    }
    public function passes($attribute, $value) {
        return !preg_match('/<\s?[^\>]*\/?\s?>/i', $value);
    }
    public function message() {
        return 'The :attribute must not be an html.';
    }
}
