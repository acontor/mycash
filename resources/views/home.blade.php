@extends('layouts.app')

@section('content')
    <div class="px-3">
        <div>
            <h1 class="mb-0 text-light">Hola {{ auth()->user()->name }}</h1>
            <small class="text-light">¡Tú puedes ahorrar!</small>
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
                                <small class="text-muted">
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
            <div class="card-body">
                <h5 class="card-title">
                    Sugerencias
                </h5>
                <p class="card-text">¿Sabías que puedes compartir una de tus cuentas con la persona que tu quieras?</p>
                <small>Próximamente</small>
                {{-- <a href="{{ route('accounts.index') }}" class="btn btn-dark">
                    <i class="bi bi-share-alt"></i>
                    <span class="ml-2">Quiero compartir</span>
                </a> --}}
            </div>
        </div>
    </div>
@endsection
