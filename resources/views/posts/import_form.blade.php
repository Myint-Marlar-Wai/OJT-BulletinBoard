@extends('layout.master')
@section('title', 'Upload CSV Screen')
@section('content')
  <div class="content border">
    <h2 class="text-center font-weight-bold mb-4"><?php echo $name; ?></h2>
    <form method="post" action="{{ route('post.import') }}" enctype="multipart/form-data">
      @csrf
      <div class="form-group row align-items-baseline">
        <label for="file" class="form-label col-md-4 text-md-right">Upload</label>
        <div class="col-md-6">
          <input id="fileInput" class="form-control" type="file" name="file">
          @error('file')
            <p class="alert alert-danger" role="alert">
              <strong>{{ $message }}</strong>
            </p>
          @enderror
          <input type="submit" id="uploader" class="btn btn-primary mx-auto" value="Import" disabled />
        </div>
      </div>
    </form>
  </div>
@endsection
