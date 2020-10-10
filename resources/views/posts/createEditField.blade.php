<div class="form-group">
    <label for="InputSlug">Введите Символьный код</label>
    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="InputSlug"
           name="slug" value="@if (isset($post)) {{ old('', $post->slug) }} @endif">
    <small>
        состоит только из латинских символов, цифр и символов тире и
        подчеркивания, поле должно быть уникальным на все статьи
    </small>
</div>
<div class="form-group">
    <label for="InputTitle">Введите Заголовок</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror"
           id="InputTitle" name="title" value="@if (isset($post)) {{ old('title', $post->title ?? '' ) }} @endif">
    <small>не менее 5 не более 100 символов</small>
</div>
<div class="form-group">
    <label for="InputExcerpt">Введите Отрывок</label>
    <input type="text" class="form-control @error('excerpt') is-invalid @enderror"
           id="InputExcerpt" name="excerpt" value="@if (isset($post)) {{ old('excerpt', $post->excerpt) }} @endif">
    <small>не более 255 символов</small>
</div>
<div class="form-group">
    <label for="InputContent">Напишите статью</label>
    <textarea class="form-control @error('content') is-invalid @enderror"
              id="InputContent" name="content" rows="10">@if (isset($post)) {{ old('content', $post->content) }} @endif</textarea>
</div>
<div class="form-check mt-3 mb-3">
    <input class="form-check-input" type="checkbox" @if (isset($post)) {{ $post->published ? 'checked' : '' }} @endif name="published"
           id="inputPublished" }}>
    <label class="form-check-label" for="inputPublished">
        Опубликовать
    </label>
</div>

