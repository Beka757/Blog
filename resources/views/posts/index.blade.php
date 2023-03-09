@extends('layouts.client')
@section('content')
    @if(count($posts) > 0)
        <table class="table table-striped border">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->name }}</td>
                    <td>
                        <div class="d-flex align-bottom">
                            <a style="text-decoration: none" class="me-3 btn btn-primary" href="{{ route('posts.edit', ['post' => $post]) }}">Edit</a>
                            <form method="post" action="{{ route('posts.destroy', ['post' => $post]) }}">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                            <a style="text-decoration: none" class="ms-3 btn btn-success" href="{{ route('posts.show', ['post' => $post]) }}">Show</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h5>No posts</h5>
    @endif
    <div class="row justify-content-md-center p-5">
        <div class="col-md-auto">
            {{ $posts->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
