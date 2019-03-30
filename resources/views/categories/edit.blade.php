@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                  <h6>
                    <b>EditCreate</b>
                  </h6>
                </div>

                <div class="card-body">
                  @include('errors.error')
                    <form method="post" action="{{ route('categories.update', $category->id) }}">
                      @method('PATCH')
                      <div class="form-group">
                        @csrf
                        <label for="name">EditCategory:</label>
                        <input type="text" class="form-control" name="name" value="{{$category->name}}">
                      </div>
                      <button type="submit" class="btn btn-success">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
