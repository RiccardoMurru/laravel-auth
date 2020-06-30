@extends('layouts.admin')

@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            New post: {{ session('success') }} created!
        </div>
    @endif
    @if (session('delete_success'))
    <div class="alert alert-warning">
        Post {{ session('delete_success') }} deleted!
    </div>
    @endif
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="my-4">Post Archive</h1>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">New Post</a>
    </div>

    @foreach ($posts as $post)
    <div class="post mb-3">
        <span>ID: {{ $post->id }}</span>
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->body }}</p>
        <p>Created at: {{ $post->created_at }}</p>
        <p>Updated at: {{ $post->updated_at }}</p>
        <div class="actions w-25 d-flex justify-content-around">
            <a href=" {{ route('admin.posts.show', $post->id) }}" class="btn btn-outline-success">Show</a>
            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-outline-primary">Edit</a>
            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input class="btn btn-outline-danger" type="submit" value="Delete">
            </form>
        </div>
    </div>
    @endforeach

    <div class="pagination mt-5">
        {{ $posts->links() }}
    </div>
</div>
@endsection