@component('mail::message')
    @foreach($posts as $post)
        Новая статья: "{{ $post->title }}"
        @component('mail::button', ['url' => '/post/' . $post->slug])
        Прочитать
        @endcomponent
    @endforeach

Thanks,<br>
{{ config('app.name') }}
@endcomponent
