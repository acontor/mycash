@extends('layouts.app')

@section('content')
    <div id="navbar-top" class="card fixed-top">
        <div class="card-body">
            <a href="{{ url()->previous() }}" class="text-secondary text-decoration-none"><</a>
            <span class="page-title float-end">Ajustes</span>
        </div>
    </div>
    <div class="m-3 mt-4">
        <h1 class="fw-bold text-light">Preferencias de tu cuenta</h1>
        <p class="text-light">Controla todos los aspectos de tu cuenta</p>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Concepto" value="{{ old('name') ?? auth()->user()->name }}" required autofocus>
                <label for="name">{{ __('Nombre') }}</label>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ old('email') ?? auth()->user()->email }}">
                <label for="email">{{ __('Email') }}</label>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Contraseña">
                <label for="password">{{ __('Contraseña') }}</label>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-floating mb-4">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" id="password-confirm" placeholder="Confirmar contraseña">
                <label for="password-confirm">{{ __('Confirmar contraseña') }}</label>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-block">{{ __('Aceptar') }}</button>
            </div>
        </form>
    </div>
@endsection
