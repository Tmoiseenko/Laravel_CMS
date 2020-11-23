@extends('admin.master')
@section('content')
    @include('admin.posts', ['posts' => $posts])
@endsection
