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
                      <small><span class="pull-left">Added {{ $post->pivot->created_at->diffforHumans() }}</span></small>
                    </div>
                  <div class="col-6 text-right">
                      <a type="button" method="POST" class="btn btn-success"
                       onclick="event.preventDefault(); document.getElementById('post-fav-destroy-{{ $post->id }}').submit();">
                       RemoveFromFavourite
                     </a>
                     <form id="post-fav-destroy-{{ $post->id }}" class="hidden" action="{{ route('post.fav.destroy', $post) }}" method="POST">
                       {{ csrf_field() }}
                       {{ method_field('DELETE') }}
                     </form>
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
            </div>
        </div>
    </div>
    <br>
    @endforeach
</div>
@endsection
