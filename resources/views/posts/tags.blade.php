@php
$tags = $tags ?? collect();
@endphp

@foreach($tags as $tag)
    <a href="{{ route('tag.show', $tag->name) }}" class="badge badge-info">{{ $tag->name }}</a>
@endforeach
