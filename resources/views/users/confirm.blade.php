@extends('layout.master')
@section('title', 'Create User Confirm')
@section('content')
    <div class="content border">
        <h2 class="text-center font-weight-bold mb-4">Confirm Page</h2>
        <form method="post" action="{{ route('user.store') }}" class="user-confirm-form mx-5"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="create_user_id" value="{{ Auth::user()->id }}">
            <div class="row">
                <div class="col-lg-3">
                    <img id="previewImg" src="/image/{{ $user['profile'] }}" alt="Profile Image"
                        style="max-width:130px;margin-bottom:20px;" />
                    <input class="form-control" type="hidden" id="profile" name="profile" value="{{ $user['profile'] }}">
                </div>
                <div class="col-lg-9">

                    <table class="table table-bordered user-confirm-tbl">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td><input type="hidden" class="form-control" id="name" name="name"
                                        value="{{ $user['name'] }}">{{ $user['name'] }}</td>
                            </tr>
                            <tr>
                                <td>Email Address</td>
                                <td><input type="hidden" class="form-control" placeholder="example@gmail.com" id="email"
                                        name="email" value="{{ $user['email'] }}">{{ $user['email'] }}</td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td><input id="password" type="hidden" class="form-control" name="password"
                                        autocomplete="current-password"
                                        value="{{ $user['password'] }}">{{ $user['password'] }}</td>
                            </tr>
                            <tr>
                                <td>Type</td>
                                <td>
                                    <input id="type" type="hidden" class="form-control" name="type"
                                        value="{{ $user['type'] }}">
                                    @if ($user['type'] == '0')
                                        <span>Admin</span>
                                    @endif
                                    @if ($user['type'] == '1')
                                        <span>User</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td><input type="hidden" class="form-control" placeholder="Enter Phone Number" id="phone"
                                        name="phone" value="{{ $user['phone'] }}">{{ $user['phone'] }}</td>
                            </tr>
                            <tr>
                                <td>Date Of Birth</td>
                                <td><input type="hidden" class="form-control" id="dob" name="dob"
                                        value="{{ $user['dob'] }}">{{ $user['dob'] }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td><textarea hidden rows="5" columns="5" id="address"
                                        name="address">{{ $user['address'] }}</textarea>{{ $user['address'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="btn-blk">
                        <button type="submit" class="btn btn-primary mr-3">Create</button>
                        <a class="btn btn-secondary" href="javascript:void(0)" onclick="goBack()">Cancle</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
