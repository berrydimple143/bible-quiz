<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    protected $fillable = [
        'category', 'level', 'items', 'score', 'status', 'time', 'user_id',
    ];
    
    public function user() {
        return $this->belongsTo('App\User');
    }
}
