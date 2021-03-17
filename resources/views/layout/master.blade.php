<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">

    <title>{{ config('app.name') }}</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/blog/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

</head>

<body>

<main role="main" class="container">

    @section('nav')
        @include('layout.nav')
    @show

    @include('layout.message')

    <div class="row">
        <div class="col-md-8 blog-main">

            @yield('content')

        </div><!-- /.blog-main -->

        @section('sidebar')
            @include('layout.sidebar')
        @show

    </div><!-- /.row -->

</main><!-- /.container -->

@include('layout.footer')

</body>
</html>
