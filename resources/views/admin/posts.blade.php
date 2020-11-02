<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Название</th>
        <th scope="col">Автор</th>
        <th scope="col">Статус</th>
        <th scope="col">Теги</th>
        <th scope="col"></th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
    <tr>
        <th scope="row">{{ $post->id }}</th>
        <td>{{ $post->title }}</td>
        <td>{{ $post->user->name }}</td>
        <td>
            @if($post->published)
                <span class="badge badge-pill badge-success">Y</span>
            @else
                <span class="badge badge-pill badge-danger">N</span>
            @endif
        </td>
        <td>
            <a href="{{ route('post.update', $post->id) }}">Изменить</a>
        </td>
        <td>
            <a href="{{ route('post.destroy', $post->id) }}">Удалить</a>
        </td>
        <td>
            @include('posts.tags', ['tags' => $post->tags])
        </td>
    </tr>
    @endforeach
    </tbody>
</table>