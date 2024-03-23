@extends('layouts.app')

@section('content')
    <div id="navbar-top" class="card fixed-top bg-transparent">
        <div class="card-body">
            <h1 class="page-title float-end text-white">MyCash</h1>
        </div>
    </div>
    <div class="container container-vertical p-4 mt-5 pt-5">
        <h1 class="fw-bold text-light">La app para tus AHORROS</h1>
        <p class="text-light">Inicia sesión y haz crecer tu dinero controlando los gastos y creando rutinas</p>
        <span class="text-light">Si eres nuevo / </span><a href="{{ route('register') }}" class="text-decoration-none text-light fw-bold">Crear cuenta</a>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-floating mt-5 mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com" value="{{ old('email') }}" required autocomplete="email">
                <label for="email">{{ __('Correo Electrónico') }}</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" required autocomplete="current-password">
                <label for="password">{{ __('Contraseña') }}</label>
            </div>
            <div class="mb-5 mt-3">
                @if (Route::has('password.request'))
                    <span class="text-light">¿No recuerdas tu contraseña? / </span><a class="text-decoration-none text-light fw-bold" href="{{ route('password.request') }}">{{ __('Recuperar') }}</a>
                @endif
            </div>
            <button type="submit" class="btn btn-light btn-lg w-100">{{ __('Iniciar sesión') }}</button>
        </form>
    </div>
@endsection
