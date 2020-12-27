<div class="form-group">
    <label for="InputSlug">Введите Символьный код</label>
    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="InputSlug"
           name="slug" value="{{ old('', $post->slug) }}">
    <small>
        состоит только из латинских символов, цифр и символов тире и
        подчеркивания, поле должно быть уникальным на все статьи
    </small>
</div>
<div class="form-group">
    <label for="InputTitle">Введите Заголовок</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror"
           id="InputTitle" name="title" value="{{ old('title', $post->title ?? '' ) }}">
    <small>не менее 5 не более 100 символов</small>
</div>
<div class="form-group">
    <label for="InputExcerpt">Введите Отрывок</label>
    <input type="text" class="form-control @error('excerpt') is-invalid @enderror"
           id="InputExcerpt" name="excerpt" value="{{ old('excerpt', $post->excerpt) }}">
    <small>не более 255 символов</small>
</div>
<div class="form-group">
    <label for="InputContent">Напишите статью</label>
    <textarea id="editor1" class="form-control @error('content') is-invalid @enderror"
              id="InputContent" name="content" rows="10"> {{ old('content', $post->content) }} </textarea>
</div>
<div class="form-check mt-3 mb-3">
    <input class="form-check-input" type="checkbox" {{ $post->published ? 'checked' : '' }} name="published"
           id="inputPublished" }}>
    <label class="form-check-label" for="inputPublished">
        Опубликовать
    </label>
</div>
<div class="form-group">
    <label for="InputTag">Теги</label>
    <input type="text" class="form-control @error('excerpt') is-invalid @enderror"
           id="InputTag" name="tags"
           value="{{ old('tags', $post->tags->pluck('name')->implode(',')) }}">
</div>

