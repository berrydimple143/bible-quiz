<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Verse extends Model
{
    protected $fillable = [
        'message', 'chapter', 'verse', 'topic_id', 'book_id',
    ];
    
    public function topic() {
        return $this->belongsTo('App\Topic');
    }
    
    public function book() {
        return $this->belongsTo('App\Book');
    }
}
