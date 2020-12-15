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

@can('update', $post)
    <p><a href="{{ route('post.edit', $post->slug) }}" class="btn btn-outline-info">Изменить</a></p>
@endcan

    <p><a href="{{ route('home') }}">На главную</a></p>

    @include('layout.comments', ['comments' => $post->comments, 'action' => route('post.comment.create', $post->id)])

@endsection
