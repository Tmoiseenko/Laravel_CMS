@extends('admin.master')
@section('content')
    <div class="panel panel-default">
    <h3 class="panel-heading">
        Редактирование статьи: {{ $post->title }}
    </h3>
    @include('layout.errors')
    <form class="panel-body" method="post" action="{{ route('admin.post.update', $post->slug) }}">
        @csrf
        @method('PATCH')
        @include('posts.createEditField')
        <button type="submit" class="btn btn-sm btn-primary">Изменить</button>
    </form>
    </div>
@endsection
