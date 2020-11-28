@extends('layout.master')

@section('content')

    @foreach($tag->posts as $post)
        <div class="blog-post">
            <h2>
                @role('admin')
                <a href="{{ route('admin.post.edit', $post->slug) }}">{{ $post->title }}</a>
                @elserole
                <a href="{{ route('post.show', ['post' => $post->slug]) }}">{{ $post->title }}</a>
                @endrole
            </h2>
            <div class="d-flex justify-content-between">
                <span class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }}</span>
                <span class="blog-post-meta">Статья</span>
            </div>
            <span>{{ $post->excerpt }}</span>
            <p class="m-2">
                @include('posts.tags', ['tags' => $post->tags])
            </p>
        </div><!-- /.blog-post -->
    @endforeach

    @foreach($tag->news as $post)
        <div class="blog-post">
            <h2>
                @role('admin')
                <a href="{{ route('admin.news.edit', $post->slug) }}">{{ $post->title }}</a>
                @elserole
                <a href="{{ route('news.show', ['news' => $post->slug]) }}">{{ $post->title }}</a>
                @endrole
            </h2>
            <div class="d-flex justify-content-between">
                <span class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }}</span>
                <span class="blog-post-meta">Новость</span>
            </div>
            <span>{{ $post->excerpt }}</span>
            <p class="m-2">
                @include('posts.tags', ['tags' => $post->tags])
            </p>
        </div><!-- /.blog-post -->
    @endforeach

@endsection