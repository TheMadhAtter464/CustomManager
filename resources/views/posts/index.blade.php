@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-6" style="padding-top:10px;">
          <h6>
            <b>MyPost</b>
          </h6>
        </div>
        <div class="col-6 text-right">
          <a type="button" class="btn btn-success" href="/post/create">Create</a>
        </div>
      </div>

    </div>
    <div class="card-body">
      <table class="table table-striped">
        <thead>
            <tr>
                <th> Id</th>
                <th> Name</th>
                <th> Categories</th>
                <th> Actions</th>
            </tr>
        </thead>
        <tbody>
             @foreach($posts as $post)
              <tr>
                  <td> {{$post->id}} </td>
                  <td> {{$post->name}} </td>
                  <td>
                    @foreach($post->categories as $category)
                      <span class="badge badge-secondary">{{ $category->name }}</span>
                    @endforeach
                  </td>
                  <td>
                    <div class="row">
                      <a href="{{ route('post.edit', $post->id)}}" class="btn btn-secondary">Edit</a>
                      <form action="{{ route('post.destroy', $post->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                      </form>
                    </div>
                  </td>
              </tr>
             @endforeach
       </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
