@extends('layout.master')
@section('title', 'Post Confirm Screen')
@section('content')
  <div class="content border">
    <h2 class="text-center font-weight-bold mb-4"><?php echo $name;?></h2>

    <div class="row">
      <div class="col-8 mx-auto">
        
        <form action="{{ route('post.update',$post['id']) }}" class="create-post" method="post">
          @csrf
          @method('PUT')
          <input type="hidden" name="id" value="{{ $post['id'] }}">
          <input type="hidden" name="updated_user_id" value="{{ Auth::user()->id }}">
          <table class="table table-bordered user-confirm-tbl">
            <tbody>
              <tr>
                <td>Title</th>
                <td>
                  <input type="hidden" name="title" class="form-control" value="{{ $post['title'] }}">
                  {{ $post['title'] }}
                </td>
              </tr>
              <tr>
                <td>Description</th>
                <td>
                  <input type="hidden" name="description" class="form-control" value="{{ $post['description'] }}">
                  {{ $post['description'] }}
                </td>
              </tr>
              <tr>
                <td>Status</th>
                <td>
                  <input type="hidden" name="status" value="{{ $post['status'] }}">
                  @if ($post['status'] == '0')
                     <span>Inactive</span> 
                  @endif
                  @if ($post['status'] == '1')
                     <span>Active</span> 
                  @endif
                </td>
              </tr>
            </tbody>
          </table>
          <div class="btn-blk">
            <button type="submit" class="btn btn-primary mr-3">Update</button>
            <a class="btn btn-secondary" href="javascript:void(0)" onclick="goBack()">Cancle</a>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection