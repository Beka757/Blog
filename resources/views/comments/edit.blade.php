@extends('layouts.client')
@section('content')
    <form action="{{ route('comments.update', ['comment' => $comment]) }}" method="post" class="w-25" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="post_id" value="{{ $comment->post->id }}">
        <div class="form-group">
            @if($errors->has('body'))
                <label for="commentFormControl">Comment</label>
                <textarea name="body" class="form-control" id="commentFormControl" rows="3"
                          style="border-color: red">{{ $comment->body }}</textarea>
                <span class="help-block text-danger">{{ $errors->first('body') }}</span>
            @else
                <label for="commentFormControl">Comment</label>
                <textarea name="body" class="form-control" id="commentFormControl" rows="3">{{ $comment->body }}</textarea>
            @endif
        </div>
        <br>
        @if($comment->picture)
            <img src="{{asset('/storage/' . $comment->picture)}}" alt="{{$comment->picture}}" style="width:50px;height:50px;"><br/><br>
            <div class="mb-3">
                <label for="formFile" class="form-label">Choose file</label>
                <input class="form-control" type="file" id="picture" name="picture" value="{{ $comment->picture }}">
            </div>
        @else
            <h5>No picture</h5>
            <div class="mb-3">
                <label for="formFile" class="form-label">Choose file</label>
                <input class="form-control" type="file" id="picture" name="picture" value="{{ $comment->picture }}">
            </div>
        @endif
        <button id="create-comment-btn" type="submit" class="btn btn-outline-primary btn-sm btn-block">Edit</button>
    </form>
@endsection
