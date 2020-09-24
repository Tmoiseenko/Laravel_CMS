@php
$tags = $tags ?? collect();
@endphp

@foreach($tags as $tag)
    <a href="/post/tag/{{ $tag->name }}" class="badge badge-info">{{ $tag->name }}</a>
@endforeach