@extends('layout.master')
@section('title', 'Post Create Screen')
@section('content')
  <div class="content border">
    <h2 class="text-center font-weight-bold mb-4"><?php echo $name;?></h2>

    <div class="row">
      <div class="col-8 mx-auto">
        <form action="{{ url('post/confirm') }}" method="POST">
          <input type="hidden" class="form-control" name="id" value="{{ Auth::user()->id }}">
          @csrf
          <div class="form-group row align-items-center">
            <label for="title">Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control" placeholder="Title..." id="title" name="title">
          </div>
          @error('title')
          <p class="alert alert-danger" role="alert">
            <strong>{{ $message }}</strong>
          </p>
          @enderror
          <div class="form-group row align-items-center">
            <label for="description">Description <span class="text-danger">*</span></label>
            <textarea rows="5" columns="5" id="description" name="description" class="form-control"></textarea>
          </div>
          @error('description')
          <p class="alert alert-danger" role="alert">
            <strong>{{ $message }}</strong>
          </p>
          @enderror
          <div class="btn-blk">
            <button type="submit" class="btn btn-primary mr-3">Confirm</button>
            <input type="reset" class="btn btn-secondary" value="Clear">
          </div>
      </form>
      </div>
    </div>
  </div>
@endsection