@extends('admin.master')
@section('content')
    <div class="panel panel-default">

        <h3 class="panel-heading">
            Редактирование статьи: {{ $post->title }}
        </h3>
        @include('layout.errors')
        <form class="panel-body" method="post" action="{{ route('admin.post.update', $post->slug) }}">
            @csrf
            @method('PATCH')
            @include('posts.createEditField')
            <button type="submit" class="btn btn-sm btn-primary">Изменить</button>
        </form>
    </div>
    <div class="panel panel-default">
        <h3 class="panel-heading">
            История изменения:
        </h3>
        <table class="table mt-4">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Пользователь</th>
                <th scope="col">Время</th>
                <th scope="col">До изменения</th>
                <th scope="col">После изменения</th>
            </tr>
            </thead>
            <tbody>@foreach($post->history as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->pivot->created_at->diffForHumans() }}</td>
                    <td>{{ $item->pivot->before }}</td>
                    <td>{{ $item->pivot->after }}</td>
                </tr>@endforeach
            </tbody>
        </table>

    </div>
@endsection

