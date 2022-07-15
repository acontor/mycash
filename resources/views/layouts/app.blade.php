<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,height=device-height initial-scale=1">

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
</head>

<body>
    <div id="app">
        @yield('content')
    </div>
    @auth
        @if (auth()->user()->acounts)
            <nav class="navbar fixed-bottom navbar-light bg-light">
                <div class="container-fluid d-flex justify-content-evenly text-center">
                    <a href="{{ route('home') }}" class="text-dark"><i class="bi bi-house fs-4"></i></a>
                    <a href="{{ route('accounts.index') }}" class="text-dark"><i class="bi bi-wallet-fill fs-4"></i></a>
                    <a class="text-decoration-none" data-bs-toggle="offcanvas" href="#offcanvasBottom" role="button" aria-controls="offcanvasBottom"><i class="bi bi-patch-plus text-primary fs-4"></i></a>
                    <a href="{{ route('notifications.index') }}" class="text-dark"><i class="bi bi-clock-history fs-4"></i></a>
                    <a class="text-decoration-none text-dark" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"><i class="bi bi-list fs-4"></i></a>
                </div>
            </nav>
        @endif
        <div class="offcanvas offcanvas-bottom rounded-top rounded-3 h-100" tabindex="-1" id="offcanvasBottom"
            aria-labelledby="offcanvasBottomLabel" data-bs-backdrop="true">
            <div class="offcanvas-header">
                <button type="button" class="btn-close offcanvas-title" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                <h5 class="text-reset" id="offcanvasBottomLabel">Operaciones</h5>
            </div>
            <div class="offcanvas-body small">
                <div class="row text-center">
                    <div class="col-6 mb-5 mt-5">
                        <a href="{{ route('transactions.create') }}" class="text-decoration-none text-dark">
                            <i class="bi bi-receipt"></i>
                            <br>Registrar
                            <br>Transacción
                        </a>
                    </div>
                    <div class="col-6 mb-5 mt-5">
                        <a href="{{ route('recurring_transactions.create') }}" class="text-decoration-none text-dark">
                            <i class="bi bi-receipt"></i>
                            <br>Crear
                            <br>Transacción Recurrente
                        </a>
                    </div>
                    <div class="col-6 mb-5">
                        <a href="{{ route('accounts.create') }}" class="text-decoration-none text-dark">
                            <i class="bi bi-wallet2"></i>
                            <br>Nueva
                            <br>Cuenta
                        </a>
                    </div>
                    <div class="col-6 mb-5">
                        <a href="#" class="text-decoration-none text-dark disabled">
                            <i class="bi bi-share"></i>
                            <br>Compartir
                            <br>Cuenta
                            <br><small>(Próximamente)</small>
                        </a>
                    </div>
                    <div class="col-6 mb-5">
                        <a href="#" class="text-decoration-none text-dark disabled">
                            <i class="bi bi-award"></i>
                            <br>Nueva
                            <br>Meta
                            <br><small>(Próximamente)</small>
                        </a>
                    </div>
                    <div class="col-6 mb-5">
                        <a href="#" class="text-decoration-none text-dark">
                            <i class="bi bi-journal-text"></i>
                            <br>Nuevo
                            <br>Informe
                            <br><small>(Próximamente)</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <button type="button" class="offcanvas-title btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                {{-- Dropdown bootstrap 5 --}}
            </div>
            <div class="offcanvas-body p-0">
                <div class="text-center body-header p-4">
                    <span class="fw-bold">{{ auth()->user()->name }}</span>
                    <br>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-dark btn-sm btn-change mt-2">Cerrar Sesión
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                                <path fill-rule="evenodd"
                                    d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                            </svg>
                        </button>
                    </form>
                </div>
                <div class="body-content p-3">
                    <h5 class="fw-bold">General</h5>
                    <a href="{{ route('profile.edit') }}" class="btn btn-link">Ajustes</a>
                </div>
            </div>
            <div class="offcanvas-footer">
                <div class="text-center p-3">
                    <div class="row">
                        <div class="col-2 offset-4">
                            <a href="https://www.linkedin.com/in/acontor/" target="_blank" class="btn btn-primary btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-linkedin" viewBox="0 0 16 16">
                                    <path
                                        d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
                                </svg>
                            </a>
                        </div>
                        <div class="col-2">
                            <a href="https://github.com/acontor" target="_blank" class="btn btn-dark btn-sm" id="github">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-github" viewBox="0 0 16 16">
                                    <path
                                        d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
