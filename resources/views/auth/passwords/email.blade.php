@extends('layouts.app')

@section('content')
    <div id="navbar-top" class="card fixed-top bg-transparent">
        <div class="card-body">
            <h1 class="page-title float-end text-white">MyCash</h1>
        </div>
    </div>
    <div class="container p-3">
        <h1 class="fw-bold text-light">¿Necesitas recuperar tu contraseña?</h1>
        <p class="text-light">Solicita una nueva contraseña</p>
        <span class="text-light">Si ya tienes cuenta / </span><a href="{{ route('login') }}" class="text-decoration-none text-light fw-bold">Inicia sesión</a>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-floating mt-5 mb-5">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com" value="{{ old('email') }}" required autocomplete="email">
                <label for="email">{{ __('Correo Electrónico') }}</label>
            </div>
            <button type="submit" class="btn btn-light btn-lg w-100">{{ __('Solicitar nueva contraseña') }}</button>
        </form>
    </div>
@endsection
