@extends('layouts.client')
@section('content')
    <h5>Create post</h5>
    <br>
    <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            @if ($errors->has('name'))
                <label for="name">Name</label>
                <input style="border-color: red" type="text" class="form-control" id="name" name="name">
                <span class="help-block text-danger">{{ $errors->first('name') }}</span>
            @else
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            @endif
        </div>
        <br>
        <div class="form-floating">
            @if ($errors->has('body'))
                <textarea name="body" class="form-control" id="body" style="height: 100px; border-color: red"></textarea>
                <label for="body">Text</label>
                <span class="help-block text-danger">{{ $errors->first('body') }}</span>
            @else
                <textarea name="body" class="form-control" id="body" style="height: 100px"></textarea>
                <label for="body">Text</label>
            @endif
        </div>
        <br>
        <div class="mb-3">
            @if($errors->has('picture'))
                <label for="formFile" class="form-label">Choose file</label>
                <input class="form-control" type="file" id="picture" name="picture" style="border-color: red">
                <span class="help-block text-danger">{{ $errors->first('picture') }}</span>
            @else
                <label for="formFile" class="form-label">Choose file</label>
                <input class="form-control" type="file" id="picture" name="picture">
            @endif
        </div>
        <br>
        <button type="submit" class="btn btn-secondary">Submit</button>
    </form>
@endsection
