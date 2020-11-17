@component('mail::message')
Статья обновлена: "{{ $post->title }}"

{{ $post->excerpt }}

@component('mail::button', ['url' => route('home') . '/post/' . $post->slug])
Посмотреть
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
