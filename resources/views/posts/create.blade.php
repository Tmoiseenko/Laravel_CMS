@extends('layout.master')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Создание статьи
    </h3>
    @include('layout.errors')
    <form method="post" action="{{ route('post.create') }}">
        @csrf
        @include('posts.createEditField')
        <div class="form-group">
            <label for="InputTag">Теги</label>
            <input type="text" class="form-control @error('excerpt') is-invalid @enderror"
                   id="InputTag" name="tags"
                   value="{{ old('tags') }}">
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
@endsection
