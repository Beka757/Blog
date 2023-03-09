@extends('layouts.client')
@section('content')
    <div class="card mb-3">
        <img style="height: 500px" src="{{asset('/storage/' . $post->picture)}}" class="card-img-top"
             alt="{{ $post->picture }}">
        <div class="card-body">
            <h5 class="card-title">{{ $post->name }}</h5>
            <p class="card-text">{{ $post->body }}</p>
            <p class="card-text"><small class="text-muted">{{ $post->updated_at->diffForHumans() }}</small></p>
        </div>
    </div>
    <br>
    <form action="{{ route('comments.store') }}" method="post" class="w-25" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="post_id" value="{{$post->id}}">
        <div class="form-group">
            @if($errors->has('body'))
                <label for="commentFormControl">Comment</label>
                <textarea name="body" class="form-control" id="commentFormControl" rows="3"
                          style="border-color: red"></textarea>
                <span class="help-block text-danger">{{ $errors->first('body') }}</span>
            @else
                <label for="commentFormControl">Comment</label>
                <textarea name="body" class="form-control" id="commentFormControl" rows="3"></textarea>
            @endif
        </div>
        <br>
        <div class="mb-3">
            <label for="formFile" class="form-label">Choose file</label>
            <input class="form-control" type="file" id="picture" name="picture">
        </div>
        <button id="create-comment-btn" type="submit" class="btn btn-outline-primary btn-sm btn-block">Add new
            comment
        </button>
    </form>
    <br>
    @if(count($post->comments) > 0)
        <h5>Comments</h5>
        @foreach($post->comments as $comment)
            @if($comment->picture)
                <div class="card">
                    <img style="height: 400px" src="{{asset('/storage/' . $comment->picture)}}" class="card-img-bottom"
                         alt="{{ $comment->picture }}">
                    <div class="card-body">
                        <p class="card-text">{{ $comment->body }}</p>
                        <p class="card-text"><small class="text-muted">{{ $comment->updated_at->diffForHumans() }}</small></p>
                        <d class="d-flex">
                            <a style="text-decoration: none" class="me-3 btn btn-primary" href="{{ route('comments.edit', ['comment' => $comment]) }}">Edit</a>
                            <form method="post" action="{{ route('comments.destroy', ['comment' => $comment]) }}">
                                <input type="hidden" name="post_id" value="{{$post->id}}">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </d>
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-body">
                        <div class="card-body">
                            <p class="card-text">{{ $comment->body }}</p>
                            <p class="card-text"><small class="text-muted">{{ $comment->updated_at->diffForHumans() }}</small></p>
                            <div class="d-flex">
                                <a style="text-decoration: none" class="me-3 btn btn-primary" href="{{ route('comments.edit', ['comment' => $comment]) }}">Edit</a>
                                <form method="post" action="{{ route('comments.destroy', ['comment' => $comment]) }}">
                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <br>
        @endforeach
    @else
        <h5>No comments</h5>
        <br>
    @endif
    <div class="row justify-content-md-center p-5">
        <div class="col-md-auto">
            {{ $post->comments->links() }}
        </div>
    </div>
@endsection
