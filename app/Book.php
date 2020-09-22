<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'name', 'shortname', 'priority',
    ];
    
    public function verses() {
        return $this->hasMany('App\Verse');
    }
}
