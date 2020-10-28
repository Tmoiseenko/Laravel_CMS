@component('mail::message')
    Статья удалена: "{{ $post->title }}"

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
