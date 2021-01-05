<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>@yield('title', config('app.name'))</title>

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>

<body>
<div class="container-fluid">
    @section('nav')
        @include('layout.nav')
    @show

    <div class="container">
        @include('layout.flash_message')
    </div>

    <main role="main" class="container py-4" id="app">
        <div class="row">

            @yield('content')

            @section('sidebar')
                @include('layout.sidebar')
            @show

        </div><!-- /.row -->
    </main><!-- /.container -->

    @include('layout.footer')
</div>
<script src="{{ mix('/js/manifest.js') }}"></script>
<script src="{{ mix('/js/vendor.js') }}"></script>
<script src="{{ mix('/js/app.js') }}"></script>

</body>
</html>
