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
    <h1 class="my-4">Create new post</h1>

    <form action=" {{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" type="text" name="title" id="title" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label for="body">Post text</label>
            <textarea class="form-control" name="body" id="body" cols="30" rows="10">{{ old('body') }}</textarea>
        </div>
        <div class="form-group">
            <label for="img_path">Example file input</label>
            <input type="file" class="form-control-file" id="img_path" accept="image/*">
        </div>
        <input class="btn btn-primary" type="submit" value="New Post">
    </form>
    
</div>
@endsection