<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = [
        'message', 'status', 'user_id',
    ];
    
    public function user() {
        return $this->belongsTo('App\User');
    }
}
