@extends('layout.master')

@section('title')
    Новости
@endsection

@section('content')
    @foreach($posts as $post)
        <div class="blog-post">
            <h2>
                @role('admin')
                <a href="{{ route('admin.news.edit', $post->slug) }}">{{ $post->title }}</a>
                @elserole
                <a href="{{ route('news.show', ['news' => $post->slug]) }}">{{ $post->title }}</a>
                @endrole
            </h2>
            <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }}</p>

            <p>{{ $post->excerpt }}</p>
            <p class="m-2">
                @include('posts.tags', ['tags' => $post->tags])
            </p>
        </div><!-- /.blog-post -->
    @endforeach

@endsection
