<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class FavouriteController extends Controller
{
  public function index(Request $request){
    $posts = $request->user()->favouritePost()->paginate(5);
    return view('favourites.index')->with('posts', $posts);
  }

//---Store to Favourites---
  public function store(Request $request){
    $postId = $request['post_id'];
    $postFind = Post::find($postId);
    $request->user()->favouritePost()->syncWithoutDetaching($postFind);
    return back();
  }

//----Remove from Favourites
  public function destroy(Request $request, Post $post){
	  $request->user()->favouritePost()->detach([$post->id]);
        return back();
   }
}
