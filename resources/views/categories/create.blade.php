@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                  <h6>
                    <b>CategoriesCreate</b>
                  </h6>
                </div>

                <div class="card-body">
                  @include('errors.error')
                    <form method="post" action="/categories">
                      <div class="form-group">
                        @csrf
                        <label for="name">CreateCategory:</label>
                        <input type="text" class="form-control" name="name">
                      </div>
                      <button type="submit" class="btn btn-success">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
