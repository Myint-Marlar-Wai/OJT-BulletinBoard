@extends('layout.master')
@section('title', 'User Profile Screen')
@section('content')
  <div class="content border">
    <input type="hidden" name="updated_user_id" value="{{ Auth::user()->id }}">
    <h2 class="text-center font-weight-bold mb-4"><?php echo $name;?></h2>
    <div class="row">
      <div class="col-8 mx-auto">
        <div class="text-right mb-4">
          <a href="{{ route('user.edit', $user->id)}}" class="btn btn-primary px-4">Edit</a>
        </div>
        <div class="row align-items-end">
          <div class="col-lg-4">
            <img id="previewImg" src="/image/{{ $user['profile'] }}" alt="Profile Image" style="max-width:180px;margin-bottom:20px;" />
          </div>
          <ul class="col-lg-8">
            <li class="font-weight-bold">Name:  {{ $user['name'] }}</li>
            <li class="font-weight-bold">
              Type:  
              @if ($user['type'] == '0')
                <span>Admin</span> 
              @endif
              @if ($user['type'] == '1')
                <span>User</span> 
              @endif
            </li>
          </ul>
        </div>
        <h2 class="border-bottom">Information</h3>
        <div class="row">
          <table class="table table-borderless user-profile-tbl">
            <tbody>
              <tr>
                <td>Eamil:</th>
                <td>{{ $user['email'] }}</td>
              </tr>
              <tr>
                <td>Phone:</th>
                <td>{{ $user['phone'] }}</td>
              </tr>
              <tr>
                <td>Date Of Birth:</th>
                <td>{{ $user['dob'] }}</td>
              </tr>
              <tr>
                <td>Address</th>
                <td>{{ $user['address'] }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
