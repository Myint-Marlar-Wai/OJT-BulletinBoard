@extends('layout.master')
@section('title', 'User List Screen')
@section('content')
<div class="content border">
  <h2 class="text-center font-weight-bold">User List</h2>
  @if(session()->get('success'))
  <div class="alert alert-success">
    {{ session()->get('success') }}  
  </div>
  @endif
  <div class="row my-4">
    <div class="col-12 d-flex mt-3">
      <form action="{{ url('/user_search') }}" method="GET" class="d-flex">
        @csrf
        <input type="text" name="name" placeholder="Name" class="form-control search-input mr-2">
        <input type="text" name="email" placeholder="Email" class="form-control search-input mr-2">
        <input type="date" name="created_from" placeholder="Created From" class="form-control search-input mr-2">
        <input type="date" name="created_to" placeholder="Created To" class="form-control search-input mr-2">
        <button type="submit" class="btn btn-primary">Search</button>
      </form>
      <a href="{{ route('user.create') }}" class="btn btn-primary ml-3">Add</a>
    </div>
  </div>
  <div class="table-responsive-lg">
    <table class="table table-bordered user-list-tbl">
      <thead class="thead-light">
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Created User</th>
          <th>Phone Number</th>
          <th>Dath Of Birth</th>
          <th>Created Date</th>
          @if (Auth::user()->type == '0')
          <th>Action</th>
          @endif
        </tr>
      </thead>
      
      <tbody>
        @if($users->count())
        @foreach($users as $user)
        <tr>
          <td><a href="#" data-toggle="modal" data-target="#staticBackdrop{{ $user->id }}">{{ $user->name }}</a></td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->user->name }}</td>
          <td>{{ $user->phone }}</td>
          <td>{{ date('Y/m/d', strtotime($user->dob)) }}</td>
          <td>{{ date('Y/m/d', strtotime($user->created_at)) }}</td>
          @if (Auth::user()->type == '0')
          <td>
            <button class="btn btn-danger" type="submit" data-toggle="modal" data-target="#delete-modal{{ $user->id }}">Delete</button>
          </td>
          @endif
        </tr>
        @endforeach
        @endif
      </tbody>
    </table>
    {!! $users->appends(\Request::except('page'))->render() !!}
    @foreach($users as $user)
    <!-- Detail Modal -->
    <div class="modal fade" id="staticBackdrop{{ $user->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content px-4 py-4">
          <h2 class="text-center font-weight-bold mb-4">User Detail</h2>
          <div class="row">
            <div class="col-12 mx-auto">
              <div class="row align-items-end">
                <div class="col-12">
                  <img id="previewImg" src="/image/{{ $user->profile }}" alt="Profile Image" style="max-width:180px;margin:0 auto 20px;display: block;" />
                  <h2 class="text-center font-weight-bold">Name: {{ $user->name }}</h2>
                </div>
              </div>
              <h2 class="border-bottom">Information</h3>
              <div class="row">
                <table class="table table-borderless user-profile-tbl">
                  <tbody>
                    <tr>
                      <td>Eamil:</th>
                      <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                      <td>Phone:</th>
                      <td>{{ $user->phone }}</td>
                    </tr>
                    <tr>
                      <td>Date Of Birth:</th>
                      <td>{{ $user->dob }}</td>
                    </tr>
                    <tr>
                      <td>Address</th>
                      <td>{{ $user->address }}</td>
                    </tr>
                    <tr>
                      <td>Created User</th>
                      <td>{{ $user->user->name }}</td>
                    </tr>
                    <tr>
                      <td>Create At</th>
                      <td>{{ date('Y/m/d', strtotime($user->created_at)) }}</td>
                    </tr>
                    <tr>
                      <td>Updated User</th>
                      <td>{{ $user->user->name }}</td>
                    </tr>
                    <tr>
                      <td>Updated At</th>
                      <td>{{ date('Y/m/d', strtotime($user->updated_at)) }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            @if (Auth::user()->type == '0')
            <a href="{{ route('user.edit', $user->id)}}" class="btn btn-primary">Edit</a>
            @endif
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    @endforeach
    
    @foreach($users as $user)
    <!--  Delete Modal -->
    <div class="modal fade" id="delete-modal{{ $user->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Delete Confirm</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Do you want to delete?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
            <form action="{{ route('user.destroy', $user->id)}}" method="post">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-primary">OK</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  
  
</div>
@endsection