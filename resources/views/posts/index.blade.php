@extends('layout.master')
@section('title', 'Post List Screen')
@section('content')
<div class="content border">
  <h2 class="text-center font-weight-bold"><?php echo $name;?></h2>
  @if(session()->get('success'))
  <div class="alert alert-success">
    {{ session()->get('success') }}  
  </div>
  @endif
  <div class="row my-4">
    <div class="col-sm-12 col-md-8 mt-3 d-flex">
      <a href="{{ route('post.create') }}" class="btn btn-primary mr-3">Add</a>
      <a href="{{ route('post.importForm') }}" class="btn btn-primary mr-3">Upload</a>
      <form action="{{ route('post.exportIntoExcel') }}" method="POST">
        @csrf
        <button class="btn btn-primary">Download</button>
      </form> 
    </div>
    <div class="col-sm-12 col-md-4 mt-3">
      <form action="{{ url('/post_search') }}" method="GET" class="d-flex">
        @csrf
        <input type="search" name="query" placeholder="Search....." class="form-control search-input typeahead">
        <button type="submit" class="btn btn-primary">Search</button></div>
      </form>
    </div>
    <div class="table-responsive-lg">
      <table class="table table-bordered list-tbl">
        <thead class="thead-light">
          <tr>
            <th>Post Title</th>
            <th>Post Description</th>
            <th>Posted User</th>
            <th>Posted Date</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
          @if($posts->count())
          @foreach($posts as $post)
          <tr>
            <td><a href="#" data-toggle="modal" data-target="#detail-{{ $post->id }}">{{ $post->title }}</a></td>
            <td>{{ $post->description }}</td>
            <td>{{ $post->user->name }}</td>
            <td>{{ date('Y/m/d', strtotime($post->created_at)) }}</td>
            <td><a href="{{ route('post.edit', $post->id)}}" class="btn btn-primary">Edit</a></td>
            <td><button class="btn btn-danger" type="submit" data-toggle="modal" data-target="#delete-modal{{ $post->id }}">Delete</button></td>
          </tr>
          @endforeach
          @endif
        </tbody>
      </table>
      {!! $posts->appends(\Request::except('page'))->render() !!}
      @foreach($posts as $post)
      <!-- Detail Modal -->
      <div class="modal fade" id="detail-{{ $post->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content px-4 py-4">
            <h2 class="text-center font-weight-bold mb-4">Post Detail</h2>
            <div class="row">
              <div class="col-12 mx-auto">
                <h2 class="border-bottom">Information</h3>
                  <div class="row">
                    <table class="table table-borderless user-profile-tbl">
                      <tbody>
                        <tr>
                          <td>Title:</th>
                            <td>{{ $post->title }}</td>
                          </tr>
                          <tr>
                            <td>Description:</th>
                              <td>{{ $post->description }}</td>
                            </tr>
                            <tr>
                              <td>Created User</th>
                                <td>{{ $post->user->name }}</td>
                              </tr>
                              <tr>
                                <td>Create At</th>
                                  <td>{{ date('Y/m/d', strtotime($post->created_at)) }}</td>
                                </tr>
                                <tr>
                                  <td>Updated User</th>
                                    <td>{{ $post->user->name }}</td>
                                  </tr>
                                  <tr>
                                    <td>Updated At</th>
                                      <td>{{ date('Y/m/d', strtotime($post->updated_at)) }}</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                    
                    @foreach($posts as $post)
                    <!--  Delete Modal -->
                    <div class="modal fade" id="delete-modal{{ $post->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <form action="{{ route('post.destroy', $post->id)}}" method="post">
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