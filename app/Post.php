<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use \Conner\Tagging\Taggable;
    
    protected $fillable = [
        'title', 'description', 'body', 'photo', 'video', 'date_posted', 'date_expired', 'user_id', 'category_id', 
        'posttype', 'visit', 'click', 'rating', 'published', 'popular', 'status', 'slug', 'author', 'reported',
    ];
    
    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public function category() {
        return $this->belongsTo('App\Category');
    }
    
    public function comments() {
        return $this->hasMany('App\Comment');
    }
}
