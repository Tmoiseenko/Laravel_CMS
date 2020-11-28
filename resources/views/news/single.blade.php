@extends('layout.master')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        {{ $news->title }}
    </h3>
    <div class="d-flex justify-content-between">
        <span class="blog-post-meta">{{ $news->created_at->toFormattedDateString() }}</span>
        <span>
            @include('posts.tags', ['tags' => $news->tags])
        </span>
    </div>
    <p>{{ $news->content }}</p>

    @can('update', $news)
        <p><a href="{{ route('post.edit', $news->slug) }}" class="btn btn-outline-info">Изменить</a></p>
    @endcan

    <p><a href="/">На главную</a></p>

@endsection