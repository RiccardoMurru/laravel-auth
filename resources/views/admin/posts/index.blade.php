@extends('layouts.admin')

@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            New post: {{ session('success') }} created!
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
        <div class="actions">
            <a href=" {{ route('admin.posts.show', $post->id) }}" class="btn btn-outline-success">Show</a>
            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-outline-primary">Edit</a>
            <a href="" class="btn btn-outline-danger">Delete</a>
        </div>
    </div>
    @endforeach

    <div class="pagination mt-5">
        {{ $posts->links() }}
    </div>
</div>
@endsection