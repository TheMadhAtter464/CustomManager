<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\User;

class PostsController extends Controller
{

    public function __construct(){
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Show post belong to user
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $posts = $user->posts;
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('posts.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,[
        'name' => 'required',
        'price' => 'required',
        'descr' => 'required',
        'categories' => 'required',
      ]);

      $post = new Post;
      $post->name = $request->input('name');
      $post->price = $request->input('price');
      $post->descr = $request->input('descr');
      //post belong to user
      $post->user_id = auth()->user()->id;
      $post->save();
      $post->categories()->sync($request->categories, false);
      return redirect('/post')->with('success', 'Post Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $post = Post::find($id);
      $categories = Category::all();
      //Check for correct user
      if(auth()->user()->id !== $post->user_id){
        return redirect('/post')->with('error', 'Unathorized page');
      }
      //dd($post);
      return view('posts.edit',compact('post', 'id'))->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request,[
        'name' => 'required',
        'price' => 'required',
        'descr' => 'required',
        'categories' => 'required',
      ]);

        $post = Post::find($id);
        $post->name = $request->input('name');
        $post->price = $request->input('price');
        $post->descr = $request->input('descr');
        $post->user_id = auth()->user()->id;
        $post->save();
        $post->categories()->sync($request->categories, false);
        return redirect('/post')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post = Post::find($id);
      $post->delete();
      return redirect('/post')->with('success', 'Post Removed');
    }
}
