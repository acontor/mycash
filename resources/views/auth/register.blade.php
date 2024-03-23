@extends('layouts.app')

@section('content')
    <div id="navbar-top" class="card fixed-top bg-transparent">
        <div class="card-body">
            <h1 class="page-title float-end text-white">MyCash</h1>
        </div>
    </div>
    <div class="container p-3">
        <h1 class="fw-bold text-light">¡Únete a nosotros!</h1>
        <p class="text-light">Empieza a ahorrar</p>
        <span class="text-light">Si ya tienes cuenta / </span><a href="{{ route('login') }}" class="text-decoration-none text-light fw-bold">Inicia sesión</a>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-floating mt-5 mb-3">
                <input type="name" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Álvaro" value="{{ old('name') }}" required autocomplete="name" autofocus>
                <label for="name">{{ __('Nombre') }}</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <label for="email">{{ __('Correo Electrónico') }}</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" required autocomplete="new-password">
                <label for="password">{{ __('Contraseña') }}</label>
            </div>
            <div class="form-floating mb-4">
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Password" required autocomplete="new-password">
                <label for="password_confirmation">{{ __('Confirmar Contraseña') }}</label>
            </div>
            <button type="submit" class="btn btn-light btn-lg w-100">{{ __('Crear cuenta') }}</button>
        </form>
    </div>
@endsection
