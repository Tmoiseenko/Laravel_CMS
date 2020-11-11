@component('mail::message')
Статья обновлена: "{{ $post->title }}"

{{ $post->excerpt }}

@component('mail::button', ['url' => base_url() . '/post/' . $post->slug])
Посмотреть
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
