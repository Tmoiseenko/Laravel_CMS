@extends('layout.master')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Создание статьи
    </h3>
    @include('layout.errors')
    <form method="post" action="{{ route('post.store') }}">
        @csrf
        @include('posts.createEditField')
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
@endsection
