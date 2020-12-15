@extends('admin.master')
@section('content')
    <table class="table mt-4">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Статус</th>
            <th scope="col">Теги</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($news as $post)
            <tr>
                <th scope="row">{{ $post->id }}</th>
                <td>{{ $post->title }}</td>
                <td>
                    @if($post->published)
                        <span class="badge badge-pill badge-success">Y</span>
                    @else
                        <span class="badge badge-pill badge-danger">N</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.news.edit', $post->slug) }}" class="btn btn-outline-info">Изменить</a>
                </td>
                <td>
                    <form method="post" action="{{ route('admin.news.destroy', $post->slug) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">Удалить</button>
                    </form>
                </td>
                <td>
                    @include('posts.tags', ['tags' => $post->tags])
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
