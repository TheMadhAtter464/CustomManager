<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //User has many posts
    public function posts(){
     return $this->hasMany('App\Post');
   }

   //--Add Likes---
   public function likePost(){
    return $this->morphedByMany('App\Post', 'liker')
                ->withPivot(['created_at'])
                ->orderBy('pivot_created_at', 'desc');
  }

    //Make Favourits
    public function favouritePost(){
     return $this->morphedByMany('App\Post', 'favouriteable')
                 ->withPivot(['created_at'])
                 ->orderBy('pivot_created_at', 'desc');
   }

    //--------


}
