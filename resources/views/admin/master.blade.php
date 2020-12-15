<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Dashboard</title>
    <link href="{{ asset('/css/admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/admin/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/admin/css/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/admin/css/styles.css') }}" rel="stylesheet">

    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i"
          rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{ asset('/js/admin/html5shiv.js') }}"></script>
    <script src="{{ asset('/js/admin/respond.min.js') }}"></script>
    <![endif]-->
</head>
<body>
@section('top-nav')
    @include('layout.admin.top-panel')
@show
@section('sidebar')
    @include('admin.sidebar')
@show


<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Dashboard</li>
        </ol>
    </div><!--/.row-->

@yield('content')


@include('layout.admin.footer')

</body>
</html>
