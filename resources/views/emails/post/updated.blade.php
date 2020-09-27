@component('mail::message')
    Статья обновлена: "{{ $post->title }}"

    {{ $post->excerpt }}

    @component('mail::button', ['url' => '/post/' . $post->slug])
        Прочитать
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
