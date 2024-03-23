@extends('layouts.app')

@section('content')
    <div id="navbar-top" class="card bg-transparent">
        <div class="card-body">
            <h1 class="page-title float-end text-white">MyCash</h1>
        </div>
    </div>
    <div class="px-4 mt-4 mb-5">
        <div>
            @php
                $hora = Carbon\Carbon::now()->hour;
            @endphp

            @if ($hora >= 5 && $hora < 12)
                <h1 class="mb-0 text-light">¡Buenos días!</h1>
                <small class="text-light">Tenemos un nuevo día por delante para cuidar nuestros ahorros</small>
            @elseif ($hora >= 12 && $hora < 18)
                <h1 class="mb-0 text-light">¡Buenas tardes!</h1>
                <small class="text-light">Sigue controlando tus gastos, es la base de tu presente y tu futuro</small>
            @else
                <h1 class="mb-0 text-light">¡Buenas noches!</h1>
                <small class="text-light">Seguro que ha sido un gran día, echa un último vistazo a tus cuentas por hoy</small>
            @endif
        </div>
        <div class="row mt-5">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <span class="ml-2 {{ auth()->user()->accounts->first()->balance >= 0 ? 'text-success' : 'text-danger' }}">{{ auth()->user()->accounts->first()->balance >= 0 ? '+ ' : '' }} {{ auth()->user()->accounts()->first()->balance }} €</span>
                        </h5>
                        <p class="card-text">
                            <a href="{{ route('accounts.show', auth()->user()->accounts->first()->id) }}" class="text-decoration-none text-secondary">
                                <small>
                                    <i class="bi bi-piggy-bank"></i>
                                    <span class="ml-2">Cuenta Principal</span>
                                </small>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <a href="{{ route('accounts.index') }}" class="text-decoration-none text-secondary">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <span class="ml-2 {{ auth()->user()->accounts()->sum('balance') >= 0 ? 'text-success' : 'text-danger' }}">{{ auth()->user()->accounts()->sum('balance') >= 0 ? '+ ' : '' }} {{ auth()->user()->accounts()->sum('balance') }} €</span>
                            </h5>
                            <p class="card-text">
                                <small>
                                    <i class="bi bi-bank"></i>
                                    <span class="ml-2">Patrimonio</span>
                                </small>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row mt-4 p-3 text-center">
            <div class="col-4">
                <small class="text-light">HOY</small>
                <br>
                <span class="{{ $transactions_today < 0 ? 'text-danger' : 'text-success' }}">{{ $transactions_today >= 0 ? '+' : '-' }} {{ $transactions_today }} €</span>
            </div>
            <div class="col-4">
                <small class="text-light">MES</small>
                <br>
                <span class="{{ $transactions_month < 0 ? 'text-danger' : 'text-success' }}">{{ $transactions_month >= 0 ? '+' : '-' }} {{ $transactions_month }} €</span>
            </div>
            <div class="col-4">
                <small class="text-light">AÑO</small>
                <br>
                <span class="{{ $transactions_year < 0 ? 'text-danger' : 'text-success' }}">{{ $transactions_year >= 0 ? '+' : '-' }} {{ $transactions_year }} €</span>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-body text-secondary">
                <h5 class="card-title">
                    Próximas funciones
                </h5>
                <img src="{{ url("/images/announcements/share-accounts.png") }}" class="w-100 shadow p-1 bg-body rounded mt-3" alt="Compartir cuentas">
                <p class="card-text mt-4">¿Sabías que puedes compartir una de tus cuentas con la persona que tu quieras?</p>
                <small>Próximamente</small>
                {{-- <a href="{{ route('accounts.index') }}" class="btn btn-dark">
                    <i class="bi bi-share-alt"></i>
                    <span class="ml-2">Quiero compartir</span>
                </a> --}}
            </div>
        </div>
    </div>
@endsection
