<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $fillable = [
        'firstname', 'lastname', 'middlename', 'email', 'password', 'ip', 'status', 'membership', 'activated_at', 'expired_at', 'subscription',
        'description', 'website', 'facebook', 'twitter', 'linkedin', 'portfolio', 'picture', 'username',
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function posts() {
        return $this->hasMany('App\Post');
    }
    public function photos() {
        return $this->hasMany('App\Photo');
    }
    public function discussions() {
        return $this->hasMany('App\Discussion');
    }
    public function rankings() {
        return $this->hasMany('App\Ranking');
    }
}
