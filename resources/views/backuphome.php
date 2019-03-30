@extends('layouts.app')

@section('content')
<div class="container">
  @foreach($posts as $post)
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-6" style="padding-top:10px;">
                      <h6>
                        <b>{{$post->name}}</b>
                      </h6>
                    </div>
                  <div class="col-6 text-right">
                    @if(!$post->favouritedBy(Auth::user()))
                      <a type="button" method="POST" class="btn btn-success"
                       onclick="event.preventDefault(); document.getElementById('post-fav-store-{{$post->id}}').submit();">
                       AddToFavorite
                     </a>
                     <form id="post-fav-store-{{$post->id}}" class="hidden" action="{{ route('post.fav.store', $post) }}" method="POST">
                       {{ csrf_field() }}
                     </form>
                    @endif
                  </div>
                </div>
              </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{$post->descr}}
                </div>
                <div class="card-footer">
                  @if(!$post->likedBy(Auth::user()))
                    <a type="button" method="POST" class="btn btn-success"
                     onclick="event.preventDefault(); document.getElementById('post-liked-store-{{$post->id}}').submit();">
                     Like
                   </a>
                   <form id="post-liked-store-{{$post->id}}" class="hidden" action="{{ route('post.like.store', $post) }}" method="POST">
                     {{ csrf_field() }}
                   </form>
                   @else
                     <a type="button" method="POST" class="btn btn-success"
                      onclick="event.preventDefault(); document.getElementById('post-liked-destroy-{{$post->id}}').submit();">
                        UnLike
                      </a>
                      <form id="post-liked-destroy-{{$post->id}}" class="hidden" action="{{ route('post.like.destroy', $post) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                      </form>
                  @endif
                </div>
            </div>
        </div>
    </div>
    <br>
    @endforeach
</div>
@endsection
