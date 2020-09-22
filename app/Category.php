<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'description', 'dummy', 'status', 'reported', 'icon',
    ];
    
    public function posts() {
        return $this->hasMany('App\Post');
    }
}
