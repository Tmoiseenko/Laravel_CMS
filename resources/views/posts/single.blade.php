@extends('layout.master')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        {{ $post->title }}
    </h3>
    <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }}</p>

    <p>{{ $post->content }}</p>

    <p><a href="/">На главную</a></p>
@endsection