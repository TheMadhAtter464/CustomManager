<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['name', 'price', 'category', 'descr'];

    //Post belongs to Category
    public function categories(){
      return $this->belongsToMany('App\Category');
    }

    public function user(){
      return $this->belongsTo('App\User');
    }

    //--Add Likes
    public function likes(){
      return $this->morphToMany('App\User', 'liker');
    }

    public function likedBy(User $user){
      return $this->likes->contains($user);
    }

    //Make favouritables
    public function favourites(){
      return $this->morphToMany('App\User', 'favouriteable');
    }

    public function favouritedBy(User $user){
	    return $this->favourites->contains($user);
    }
    //------------



}
