@extends('layout.master')

@section('content')
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Email</th>
            <th scope="col">Сообщенеи</th>
            <th scope="col">Дата</th>
        </tr>
        </thead>
        <tbody>
    @foreach($feedbacks as $feedback)
            <tr>
                <td>{{ $feedback->email }}</td>
                <td>{{ $feedback->text }}</td>
                <td>{{ $feedback->created_at->toFormattedDateString() }}</td>
            </tr>
    @endforeach
        </tbody>
    </table><!-- /.messages-table -->
@endsection
