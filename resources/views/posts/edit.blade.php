@extends('layout.master')
@section('title', 'Update Post Screen')
@section('content')
  <div class="content border">
    <h2 class="text-center font-weight-bold mb-4"><?php echo $name;?></h2>

    <div class="row">
      <div class="col-8 mx-auto">
        <form method="POST" action="{{ route('post.updateConfirm',$post->id)}}" id="post-edit-form">
          @csrf
          <input type="hidden" class="form-control" name="id" value="{{ $post->id }}">
          <div class="form-group">
            <label for="title">Title <span class="text-danger">*</span></label>
            <input type="text" name="title" value="{{ $post->title }}" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="description">Description <span class="text-danger">*</span></label>
            <textarea rows="5" columns="5" name="description" value="{{ $post->description }}" style="resize: none;" class="form-control">{{ $post->description }}</textarea>
        </div>
        <p class="mb-0">Status</p>
          <label class="switch">
            <input type="checkbox" name="status">
            <span class="status round"></span>
          </label>

        <div class="btn-blk mt-3">
          <button type="submit" class="btn btn-primary mr-3">Confirm</button>
          <a class="btn btn-secondary" href="javascript:void(0)" onclick="clearVal()">Clear</a>
        </div>
      </form>
      </div>
    </div>
  </div>
@endsection

<script>
  /* Clear All Input Value */
  function clearVal() {
    var inputElements = document.querySelectorAll('input, textarea, select');
    for (var i=0; i < inputElements.length; i++) {
        inputElements[i].value = '';
    }
  }
</script>