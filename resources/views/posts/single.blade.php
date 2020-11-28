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

    <p><a href="/">На главную</a></p>

    {{--@include('layout.comments', ['comments' => $comments])--}}
    <hr>
    <h3>Кооментарии</h3>
    @foreach($post->comments as $comment)
    <div class="media m-2 p-2 border bottom-radius border-info">
            <div class="media-body">
                <h5 class="mt-0">{{ $comment->name }}</h5>
                <h6 class="mt-0">{{ $comment->email }}</h6>
                <p>{{ $comment->message }}</p>
            </div>
    </div>
    @endforeach

@endsection
