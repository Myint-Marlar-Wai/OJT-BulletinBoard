@extends('layout.master')
@section('title', 'Post Confirm Screen')
@section('content')
    <div class="content border">
        <h2 class="text-center font-weight-bold mb-4">Post Confirm</h2>
        <div class="row">
            <div class="col-8 mx-auto">
                <form action="{{ route('post.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="create_user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="updated_user_id" value="{{ Auth::user()->id }}">
                    <table class="table table-bordered post-confirm-tbl">
                        <input type="hidden" class="form-control" name="id" value="{{ Auth::user()->id }}">
                        <tbody>
                            <tr>
                                <td>Title1</th>
                                <td>
                                    <input type="hidden" class="form-control" id="title" name="title"
                                        value="{{ $post['title'] }}">
                                    {{ $post['title'] }}
                                </td>
                            <tr>
                                <td>Description</th>
                                <td>
                                    <input type="hidden" class="form-control" id="description" name="description"
                                        value="{{ $post['description'] }}">
                                    {{ $post['description'] }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="btn-blk">
                        <button type="submit" class="btn btn-primary mr-3">Create</button>
                        <a class="btn btn-secondary" href="javascript:void(0)" onclick="goBack()">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
