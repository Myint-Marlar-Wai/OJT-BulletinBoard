@extends('layout.master')
@section('title', 'Upload CSV Screen')
@section('content')
  <div class="content border">
    <h2 class="text-center font-weight-bold mb-4"><?php echo $name;?></h2>
    <form>
      <div class="form-group row align-items-baseline">
        <label for="upload" class="form-label col-md-4 text-md-right">Upload</label>
        <div class="col-md-6">
          <input class="form-control" type="file" id="profile">
          <button type="submit" class="btn btn-primary mx-auto">Import</button>
        </div>  
      </div>
    </form>
  </div>
@endsection
