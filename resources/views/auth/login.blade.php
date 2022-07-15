@extends('layouts.app')

@section('content')
    <div class="container p-3">
        <h1 class="fw-bold text-light">¡Bienvenido!</h1>
        <p class="text-light">Inicia sesión para continuar</p>
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
            <button type="submit" class="btn btn-primary btn-lg w-100">{{ __('Iniciar sesión') }}</button>
        </form>
    </div>
@endsection
