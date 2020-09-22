<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $fillable = [
        'label', 'status', 'quiz_id',
    ];
    
    public function quiz() {
        return $this->belongsTo('App\Quiz');
    }
}
