@extends('layouts.app')

@section('after_styles')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                  <h6>
                    <b>PostCreate</b>
                  </h6>
                </div>

                <div class="card-body">
                  @include('errors.error')
                    <form method="post" action="/post">
                      <div class="form-group">
                        @csrf
                        <label for="name">Book Name:</label>
                        <input type="text" class="form-control" name="name"/>
                      </div>
                      <div class="form-group">
                        <label for="price">Book Price :</label>
                        <input type="text" class="form-control" name="price"/>
                      </div>
                      <div class="form-group">
                        <label for="category">Book Category:</label>
                        <select class="form-control select2-multi" name="categories[]" multiple="multiple">
                          @foreach($categories as $category)
                            <option value='{{ $category->id }}'>{{ $category->name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="descr">Book Decription:</label>
                        <textarea rows="5" class="form-control" name="descr"></textarea>
                      </div>
                      <button type="submit" class="btn btn-success">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('after_scripts')

  <script src="{{asset('js/parsley.min.js')}}" charset="utf-8"></script>
  <script src="{{asset('js/select2.min.js')}}" charset="utf-8"></script>
	<script type="text/javascript">
		$('.select2-multi').select2();
	</script>

@endsection
