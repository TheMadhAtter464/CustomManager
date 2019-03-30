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
                      <a type="button"  id="buttonFav-{{$post->id}}" data-post_id="{{ $post->id }}" class=" btn btn-success addtofav">
                       AddToFavourite
                      </a>
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
                    <a type="button"  id="buttonLike-{{$post->id}}" data-post_id="{{ $post->id }}" class=" btn btn-success like">
                     Like
                    </a>
                   @else
                     <a type="button"  id="buttonLike-{{$post->id}}" data-post_id="{{ $post->id }}" class=" btn btn-success unlike">
                      unLike
                     </a>
                  @endif
                </div>
            </div>
        </div>
    </div>
    <br>
    @endforeach
</div>
@endsection

@section('after_scripts')
<script type="text/javascript">

//AJAX add like to Post
  var token = '{{ Session::token() }}';
  var urlLike = '{{ route('post.like.store', $post) }}';

  $(document).on('click', '.like', function(event){
    event.preventDefault();
    post_id = event.target.dataset['post_id'];
    $.ajax({
      method: 'POST',
      url: urlLike,
      data: {post_id:post_id, _token:token}
    })
      .done(function(){
        $("#buttonLike-" + post_id).addClass('unlike').removeClass('like').text("unLike");
        //console.log("button pressed" + post_id);
      });
  });

  //AJAX remove like from Post
  var urlunLike = '{{ route('post.like.destroy', $post) }}';

  $(document).on('click', '.unlike', function (event){
    event.preventDefault();
    post_id = event.target.dataset['post_id'];
    $.ajax({
      type:'POST',
      url: urlunLike,
      data: {post_id:post_id, _token:token, _method:'DELETE'}
    }).done(function(){
        $("#buttonLike-" + post_id).addClass('like').removeClass('unlike').text("Like");
        //console.log("button pressed to remove" + post_id);
      });
  });

  //AJAX add to favouritedBy
  var urlAddToFav = '{{ route('post.fav.store', $post) }}';

  $(document).on('click', '.addtofav', function(event){
    event.preventDefault();
    post_id = event.target.dataset['post_id'];
    $.ajax({
      method: 'POST',
      url: urlAddToFav,
      data: {post_id:post_id, _token:token}
    }).done(function(){
      $("#buttonFav-" + post_id).remove();
    });
  });
</script>

@endsection
