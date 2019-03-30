@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-6" style="padding-top:10px;">
          <h6>
            <b>Catgories</b>
          </h6>
        </div>
        <div class="col-6 text-right">
          <a type="button" class="btn btn-success" href="/categories/create">Create</a>
        </div>
      </div>

    </div>
    <div class="card-body">
      <table class="table table-striped">
        <thead>
            <tr>
                <th> Id</th>
                <th> Name</th>
                <th> Actions</th>
            </tr>
        </thead>
        <tbody>
             @foreach($categories as $category)
              <tr>
                  <td> {{$category->id}} </td>
                  <td> {{$category->name}} </td>
                  <td>
                    <div class="row">
                      <a href="{{ route('categories.edit', $category->id)}}" class="btn btn-secondary">Edit</a>
                      <form action="{{ route('categories.destroy', $category->id)}}" method="post">
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
