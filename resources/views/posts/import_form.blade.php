@extends('layout.master')
@section('title', 'Upload CSV Screen')
@section('content')
  <div class="content border">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
    <h2 class="text-center font-weight-bold mb-4"><?php echo $name;?></h2>
    <form method="post" action="{{ route('post.import') }}" enctype="multipart/form-data">
      @csrf
      <div class="form-group row align-items-baseline">
        <label for="file" class="form-label col-md-4 text-md-right">Upload</label>
        <div class="col-md-6">
          <input class="form-control" type="file" name="file">
          <button type="submit" class="btn btn-primary mx-auto">Import</button>
        </div>  
      </div>
    </form>
  </div>
@endsection
