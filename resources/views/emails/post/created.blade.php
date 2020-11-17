@component('mail::message')
Новая статья: "{{ $post->title }}"

{{ $post->excerpt }}

@component('mail::button', ['url' => route('home') . '/post/' . $post->slug])
Прочитать
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
