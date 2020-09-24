@extends('layout.master')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        {{ $post->title }}
    </h3>
    <div class="d-flex justify-content-between">
        <span class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }}</span>
        <span>
            @include('posts.tags', ['tags' => $post->tags])
        </span>
    </div>
    <p>{{ $post->content }}</p>

    <p><a href="/post/{{ $post->slug }}/edit" class="btn btn-outline-info">Изменить</a></p>
    <p><a href="/">На главную</a></p>

@endsection
