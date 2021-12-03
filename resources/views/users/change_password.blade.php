@extends('layout.master')
@section('title', 'Change Password Screen')
@section('content')
<div class="content border">
  <h2 class="text-center font-weight-bold mb-4">Change Password Screen</h2>
  @if(session()->has('error'))
  <span class="alert alert-danger">
    <strong>{{ session()->get('error') }}</strong>
  </span>
  @endif
  @if(session()->has('success'))
  <span class="alert alert-success">
    <strong>{{ session()->get('success') }}</strong>
  </span>
  @endif
  <form method="POST" action="{{ route('user.changePassword', $user->id) }}">
    @csrf
    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>
        <div class="col-md-6">
            <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" autocomplete="current_password">
            @error('current_password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
        <div class="col-md-6">
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="password">
            @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">Password Confirmation</label>
        <div class="col-md-6">
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="password_confirmation">
            @error('password_confirmation')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
        </div>
    </div>
    <div class="btn-blk">
        <button type="submit" class="btn btn-primary mr-3">Change</button>
        <input type="reset" class="btn btn-secondary" value="Clear">
      </div>
</form>
</div>
@endsection
