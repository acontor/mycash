<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,height=device-height, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="/js/app.js?v={{ filemtime(public_path('js/app.js')) }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="/css/app.css?v={{ filemtime(public_path('css/app.css')) }}" rel="stylesheet">
    <link href="/css/custom.css?v={{ filemtime(public_path('css/custom.css')) }}" rel="stylesheet">
    @laravelPWA
    @yield('head')
</head>

<body>
    <div id="app">
        @yield('content')
    </div>
    @auth
        @include('layouts.navbar-top')
        @include('layouts.navbar-bottom')
        @include('layouts.operations')
        @include('layouts.menu')
    @endauth
    @yield('scripts')
    <script>
        $(window).on('load', function() {

            if ($('#navbar-top').length > 0) {
                $(window).on("scroll load resize", function() {
                    checkScroll();
                });
            }
        });

        function checkScroll() {
            if ($(window).scrollTop() > 10) {
                $('.page-title').addClass("scrolled");
                $('.page-info').addClass("scrolled");
                $('#navbar-top').addClass("scrolled");
            } else {
                $('.page-title').removeClass("scrolled");
                $('.page-info').removeClass("scrolled");
                $('#navbar-top').removeClass("scrolled");
            }
        }
    </script>
</body>

</html>
