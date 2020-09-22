<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'question', 'answer', 'category', 'type', 'status', 'verse',
    ];
    
    public function choices() {
        return $this->hasMany('App\Choice');
    }
}
