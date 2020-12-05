<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>@yield('title', config('app.name'))</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="/css/blog.css" rel="stylesheet">
</head>

<body>
@include('layout.nav')

    <div class="container">
        @include('layout.flash_message')
    </div>

    <main role="main" class="container py-4">
        <div class="row">

            @yield('content')

            @section('sidebar')
                @include('layout.sidebar')
            @show

        </div><!-- /.row -->
    </main><!-- /.container -->

@include('layout.footer')
</body>
</html>
