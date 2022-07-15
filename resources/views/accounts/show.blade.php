@extends('layouts.app')

@section('content')
    <div id="navbar-top" class="card fixed-top">
        <div class="card-body">
            <a href="{{ url()->previous() }}" class="text-secondary text-decoration-none"><</a>
            <span class="page-title float-end">Cuentas</span>
        </div>
    </div>
    <div class="row m-3 text-light">
        <div class="col-6 mt-1">
            <h2>{{ $account->name }}</h2>
            <small>{{ $account->category->name }}</small>
        </div>
        <div class="col-6 mt-2">
            <span class="float-end {{ $account->balance >= 0 ? 'text-success' : 'text-danger' }}">{{ $account->balance >= 0 ? '+ ' : '' }} {{ $account->balance }} €</span>
        </div>
    </div>
    <div class="row text-center mt-4 pb-3">
        <div class="col-4">
            <a href="{{ route('transactions.create') }}" class="text-decoration-none text-white fw-bold">
                <i class="bi bi-receipt"></i><br>
                Registrar<br>
                Transacción
            </a>
        </div>
        <div class="col-4">
            <a href="{{ route('recurring_transactions.index', $account) }}" class="text-decoration-none text-white fw-bold">
                <i class="bi bi-receipt"></i><br>
                Transacciones<br>
                Recurrentes
            </a>
        </div>
        <div class="col-4">
            <a href="{{ route('accounts.edit', $account) }}" class="text-decoration-none text-white fw-bold">
                <i class="bi bi-pencil-square"></i><br>
                Editar<br>
                Cuenta
            </a>
        </div>
    </div>
    <div class="card m-3">
        <div class="row px-3 mt-3">
            <div class="col-10">
                <h5>Transacciones</h5>
            </div>
            <div class="col-2 text-end">
                <a class="text-decoration-none text-primary fw-bold">
                    <i class="bi bi-search"></i><br>
                </a>
            </div>
            <div class="col-12">
                <small class="text-muted">Últimas transacciones de tu cuenta</small>
            </div>
        </div>
        <hr>
        <div class="row px-3">
            @forelse ($account->transactions as $key => $transaction)
                <div class="col-12 mb-3">
                    <a href="{{ route('transactions.show', $transaction->id) }}" class="text-decoration-none text-secondary">
                        <div class="py-2">
                            <div class="row">
                                <div class="col-6">
                                    <b class="text-dark">{{ $transaction->name }}</b><br>
                                    <small class="text-muted">{{ substr($transaction->description, 0, 20) }}</small>
                                </div>
                                <div class="col-6 text-end">
                                    <span class="{{ $transaction->amount >= 0 ? 'text-success' : 'text-danger' }}">{{ $transaction->amount }} €</span><br>
                                    <small>{{ $transaction->created_at->format('d/m/Y') }}</small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 mb-3">
                    <div class="py-3">
                        <span class="text-muted">No hay transacciones registradas / </span><a href="{{ route('transactions.create', $account) }}" class="text-decoration-none text-dark fw-bold">Crear una</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
