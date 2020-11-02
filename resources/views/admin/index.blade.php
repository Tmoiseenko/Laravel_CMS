@extends('layout.master')
@section('nav')
    @include('layout.admin.nav')
@endsection
@section('sidebar')
    @include('admin.sidebar')
@endsection
@section('content')
    @include('admin.posts', ['posts' => $posts])
@endsection
