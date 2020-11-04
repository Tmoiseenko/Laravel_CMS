@extends('admin.master')
@section('content')
    <h3 class="pb-3 m-4 font-italic border-bottom">
        Редактирование статьи: {{ $post->title }}
    </h3>
    @include('layout.errors')
    <form method="post" action="{{ route('admin.post.update', $post->slug) }}">
        @csrf
        @method('PATCH')
        @include('posts.createEditField')
        <button type="submit" class="btn btn-primary ">Изменить</button>
    </form>
@endsection
