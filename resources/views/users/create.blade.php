@extends('layout.master')
@section('title', 'User Create Screen')
@section('content')
<div class="content border">
  <h2 class="text-center font-weight-bold mb-4"><?php echo $name;?></h2>
  <form method="post" action="{{ url('user/confirm') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id">
    <div class="form-group row align-items-center">
      <label for="name" class="col-md-4 text-md-right ">Name <span class="text-danger">*</span></label>
      <div class="col-md-6">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
          </div>
          <input type="text" class="form-control" placeholder="Name" id="name" name="name">
        </div>
        @error('name')
          <p class="alert alert-danger" role="alert">
            <strong>{{ $message }}</strong>
          </p>
          @enderror
      </div>
    </div>
    <div class="form-group row align-items-center">
      <label for="email" class="col-md-4 text-md-right">Email Address <span class="text-danger">*</span></label>
      <div class="col-md-6">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
          </div>
          <input type="text" class="form-control" placeholder="example@gmail.com" id="email" name="email">
        </div>
        @error('email')
        <p class="alert alert-danger" role="alert">
          <strong>{{ $message }}</strong>
        </p>
        @enderror
      </div>
    </div>
    <div class="form-group row align-items-center">
      <label for="passward" class="col-md-4 text-md-right">Password <span class="text-danger">*</span></label>
      <div class="col-md-6">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-key"></i></span>
          </div>
          <input id="password" type="password" class="form-control" name="password" autocomplete="current-password">
        </div>
        @error('password')
          <p class="alert alert-danger" role="alert">
            <strong>{{ $message }}</strong>
          </p>
          @enderror
      </div>
    </div>
    <div class="form-group row align-items-center">
      <label for="password-confirm" class="col-md-4 text-md-right">Confirm Password <span class="text-danger">*</span></label>
      <div class="col-md-6">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-key"></i></span>
          </div>
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
        </div>
      </div>
    </div>
    <div class="form-group row align-items-baseline">
      <label for="profile" class="form-label col-md-4 text-md-right">Profile</label>
      <div class="col-md-6">
        <input class="form-control" type="file" id="profile" name="profile" onChange="previewFile()">
        <img id="previewImg" src="/image/demo.png" alt="Profile Image" style="max-width:130px;margin-top:10px;" />
      </div>  
    </div>
    <div class="form-group row align-items-center">
      <label for="type" class="col-md-4 text-md-right">Type <span class="text-danger">*</span></label>
      <div class="col-md-6">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
          </div>
          <select class="form-control" id="type" name="type">
            <option selected>Select Type</option>
            <option value="0">Admin</option>
            <option value="1">User</option>
          </select>
        </div>
        @error('type')
          <p class="alert alert-danger" role="alert">
            <strong>{{ $message }}</strong>
          </p>
          @enderror
      </div>
    </div>
    <div class="form-group row align-items-center">
      <label for="phone" class="col-md-4 text-md-right">Phone</label>
      <div class="col-md-6">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-phone-square" aria-hidden="true"></i>
            </span>
          </div>
          <input type="tel" class="form-control" placeholder="Enter Phone Number" id="phone" name="phone">
        </div>
      </div>
    </div>
    <div class="form-group row align-items-center">
      <label for="dob" class="col-md-4 text-md-right">Date Of Birth</label>
      <div class="col-md-6">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
          </div>
          <input type="date" class="form-control" id="dob" name="dob">
        </div>
      </div>
    </div>
    <div class="form-group row align-items-center">
      <label for="address" class="col-md-4 text-md-right">Address</label>
      <div class="col-md-6">
        <textarea rows="5" columns="5" id="address" name="address"></textarea>
      </div>
    </div>
    <div class="btn-blk">
      <button type="submit" class="btn btn-primary mr-3">Confirm</button>
      <input type="reset" class="btn btn-secondary" value="Clear">
    </div>
  </form>
</div>
@endsection
<script>
  function previewFile(input) {
    var file = $("input[type=file]").get(0).files[0];
    if(file) {
      var reader = new FileReader();
      reader.onload = function() {
        $("#previewImg").attr("src",reader.result);
      }
      reader.readAsDataURL(file);
    }
  }
</script>