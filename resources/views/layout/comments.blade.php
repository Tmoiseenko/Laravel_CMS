<hr>
<h5>Оставить комментарий</h5>
<hr>
@include('layout.errors')
@include('layout.comment-form')
<hr>
@foreach($comments as $comment)
    <div class="media m-2 p-2 border bottom-radius border-info">
        <div class="media-body">
            <h5 class="mt-0">{{ $comment->name }}</h5>
            <h6 class="mt-0">{{ $comment->email }}</h6>
            <p>{{ $comment->message }}</p>
        </div>
    </div>
@endforeach