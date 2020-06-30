@extends('layouts.admin')

@section('content')
<div class="container">
    @if (session('success'))
    <div class="alert alert-success">
        New post: {{ session('success') }} created!
    </div>
    @endif
    <div class="d-flex justify-content-between align-items-center>
        <h1 class="my-4">Post Details</h1>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">New Post</a>
    </div>

    <div class="post my-3 p-3 border border-info rounded"">
        <span>ID: {{ $post->id }}</span>
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->body }}</p>
        <p>Created at: {{ $post->created_at }}</p>
        <p>Updated at: {{ $post->updated_at }}</p>
        <div class="actions d-flex justify-content-around align-items-center">
            <a href="" class="btn btn-outline-primary">Edit</a>
            <a href="" class="btn btn-outline-danger">Delete</a>
        </div>
    </div>
</div>
@endsection