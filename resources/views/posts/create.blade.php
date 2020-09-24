@extends('layout.master')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        {{ $title }}
    </h3>
    @include('layout.errors')
    <form method="post" action="/post">
        @csrf
        <div class="form-group">
            <label for="InputSlug">Введите Символьный код</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="InputSlug" name="slug">
            <small>состоит только из латинских символов, цифр и символов тире и подчеркивания, поле должно быть уникальным на все статьи</small>
        </div>
        <div class="form-group">
            <label for="InputTitle">Введите Заголовок</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="InputTitle" name="title">
            <small>не менее 5 не более 100 символов</small>
        </div>
        <div class="form-group">
            <label for="InputExcerpt">Введите Отрывок</label>
            <input type="text" class="form-control @error('excerpt') is-invalid @enderror" id="InputExcerpt" name="excerpt">
            <small>не более 255 символов</small>
        </div>
        <div class="form-group">
            <label for="InputContent">Напишите статью</label>
            <textarea class="form-control @error('content') is-invalid @enderror" id="InputContent" name="content" rows="10"></textarea>
        </div>
        <div class="form-check mt-3 mb-3">
            <input class="form-check-input" type="checkbox" value="" name="published" id="inputPublished">
            <label class="form-check-label" for="inputPublished">
                Опубликовать
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
@endsection
