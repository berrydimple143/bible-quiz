<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manipulate extends Model
{
    protected $fillable = [
        'format', 'width', 'height',
    ];
}
