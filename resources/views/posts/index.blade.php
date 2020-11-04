@extends('layout.master')

@section('content')
    @foreach($posts as $post)
        <div class="blog-post">
            <h2>
                @role('admin')
                    <a href="{{ route('admin.post.edit', $post->slug) }}">{{ $post->title }}</a>
                @elserole
                    <a href="{{ route('post.show', ['post' => $post->slug]) }}">{{ $post->title }}</a>
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
