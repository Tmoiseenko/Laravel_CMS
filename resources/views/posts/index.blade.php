@extends('layout.master')

@section('content')
    @foreach($posts as $post)
    <div class="blog-post">
        <h2><a href="/post/{{ $post->slug }}">{{ $post->title }}</a></h2>
        <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }}</p>

        <p>{{ $post->excerpt }}</p>

    </div><!-- /.blog-post -->
    @endforeach

@endsection
