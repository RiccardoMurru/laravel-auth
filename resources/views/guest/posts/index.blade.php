@extends('layouts.app')

@section('content')
<div class="container">
   <h1 class="my-4">Post Archive</h1>
   @foreach ($posts as $post)
        <div class="post mb-3">
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->body }}</p>
        </div>
    @endforeach
    
    <div class="pagination">
        {{ $posts->links() }}
    </div>
</div>
@endsection