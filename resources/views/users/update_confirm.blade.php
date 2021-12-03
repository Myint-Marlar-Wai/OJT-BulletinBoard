@extends('layout.master')
@section('title', 'Update User Confirm')
@section('content')
  <div class="content border">
    <h2 class="text-center font-weight-bold mb-4">Update User Confirmation</h2>
    <form method="post" action="{{ route('user.update', $user['id'] ) }}" class="user-confirm-form mx-5" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="updated_user_id" value="{{ Auth::user()->id }}">
      <div class="row">
        <input type="hidden" class="form-control" name="id" value="{{ $user['id'] }}">
        <input type="hidden" name="updated_user_id" value="{{ Auth::user()->id }}">
        <div class="col-lg-3">
          <input class="form-control" type="hidden" id="profile" name="profile" value="{{ $user['profile'] }}">   
          <img id="previewImg" src="/image/{{ $user['profile'] }}" alt="Profile Image" style="max-width:130px;margin-bottom:20px;" />
        </div>
        <div class="col-lg-9">
          <table class="table table-bordered user-confirm-tbl">
            <tbody>
              <tr>
                <td>Name</th>
                 
                <td><input type="hidden" class="form-control" id="name" name="name" value="{{ $user['name'] }}">{{ $user['name'] }}</td>
              </tr>
              <tr>
                <td>Email Address</th>
                <td><input type="hidden" class="form-control" placeholder="example@gmail.com" id="email" name="email" value="{{ $user['email'] }}">{{ $user['email'] }}</td>
              </tr>
              <tr>
                <td>Type</th>
                <td>
                  <input id="type" type="hidden" class="form-control" name="type" value="{{ $user['type'] }}">
                  @if ($user['type'] == '0')
                     <span>Admin</span> 
                  @endif
                  @if ($user['type'] == '1')
                     <span>User</span> 
                  @endif
                </td>
              </tr>
              <tr>
                <td>Phone</th>
                <td><input type="hidden" class="form-control" placeholder="Enter Phone Number" id="phone" name="phone" value="{{ $user['phone'] }}">{{ $user['phone'] }}</td>
              </tr>
              <tr>
                <td>Date Of Birth</th>
                <td><input type="hidden" class="form-control" id="dob" name="dob" value="{{ $user['dob'] }}">{{ $user['dob'] }}</td>
              </tr>
              <tr>
                <td>Address</th>
                <td><textarea hidden rows="5" columns="5" id="address" name="address">{{ $user['address'] }}</textarea>{{ $user['address'] }}</td>
              </tr>
            </tbody>
          </table>
          <div class="btn-blk">
            <button type="submit" class="btn btn-primary mr-3">Update</button>
            <a class="btn btn-secondary" href="javascript:void(0)" onclick="goBack()">Cancle</a>
          </div>
        </div>
        </div>
      </div>
    </form>
  </div>
@endsection