@extends('layout.master')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Редактирование статьи
    </h3>
    @include('layout.errors')
    <form method="post" action="{{ route('post.update', $post->slug) }}">
        @csrf
        @method('PATCH')
        @include('posts.createEditField')

        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>

    <form class="mt-4" method="post" action="{{ route('post.destroy', $post->slug) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger">Удалить</button>
    </form>
@endsection
