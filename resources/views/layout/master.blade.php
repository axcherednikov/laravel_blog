<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>@yield('title', config('app.name'))</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <script>
        let userId = {{ auth()->id() }};
    </script>
</head>

<body class="d-flex flex-column min-vh-100">
<div class="wrapper flex-grow-1">
    <div class="container">
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

            </div>
            <chat></chat>
        </main>
    </div>
</div>

@include('layout.footer')

<script src="{{ mix('/js/manifest.js') }}"></script>
<script src="{{ mix('/js/vendor.js') }}"></script>
<script src="{{ mix('/js/app.js') }}"></script>

</body>
</html>
