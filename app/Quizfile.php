<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quizfile extends Model
{
    protected $fillable = [
        'filename', 'delete',
    ];
}
