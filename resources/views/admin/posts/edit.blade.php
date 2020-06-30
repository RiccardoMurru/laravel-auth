@extends('layouts.admin')

@section('content')
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <h1 class="my-4">Edit post</h1>

    <form action=" {{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $post->title) }}">
        </div>
        <div class="form-group">
            <label for="body">Post text</label>
            <textarea class="form-control" name="body" id="body" cols="30" rows="10">{{ old('body', $post->body) }}</textarea>
        </div>
        <div class="form-group">
            @isset($post->img_path)
            <img src="{{ asset('storage' . '/' . $post->img_path) }}" alt="{{ $post->title }}" width="300" class="rounded d-block mb-3">
            @endisset
            <label for="img_path">Chose an image file</label>
            <input type="file" class="form-control-file" name="img_path" id="img_path" accept="image/*">
        </div>
        <input class="btn btn-primary" type="submit" value="Update Post">
    </form>

</div>
@endsection