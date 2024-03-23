@extends('layouts.app')

@section('content')
    <div id="content">
        <div class="row m-3 text-light mb-5">
            <div class="col-6 mt-1">
                <h2>{{ $account->name }}</h2>
                <small>{{ $account->category->name }}</small>
            </div>
            <div class="col-6 mt-2">
                <span class="float-end {{ $account->balance >= 0 ? 'text-success' : 'text-danger' }}">{{ $account->balance >= 0 ? '+ ' : '' }} {{ $account->balance }} €</span>
            </div>
        </div>
        <div class="row text-center mt-4 pb-3">
            <div class="col-12">
                <a href="{{ route('recurring_transactions.create', $account) }}" class="text-decoration-none text-white fw-bold">
                    <i class="bi bi-wallet2"></i>
                    <br>Crear
                    <br>Transacción
                </a>
            </div>
        </div>
        <div class="card m-3 text-secondary">
            <div class="row px-3 mt-3">
                <div class="col-10">
                    <h5>Transacciones recurrentes</h5>
                </div>
                <div class="col-2 text-end">
                    <a class="text-decoration-none text-secondary fw-bold">
                        <i class="bi bi-search"></i><br>
                    </a>
                </div>
                <div class="col-12">
                    <small class="text-muted">Revisa las transacciones recurrentes de tu cuenta</small>
                </div>
            </div>
            <hr>
            <div class="row px-3">
                @forelse ($recurringTransactions as $recurringTransaction)
                    <div class="col-12 mb-3">
                        <a href="{{ route('recurring_transactions.show', $recurringTransaction) }}" class="text-decoration-none text-secondary">
                            <div class="py-3">
                                <span class="text-secondary">{{ $recurringTransaction->name }}</span>
                                <div class="float-end {{ $recurringTransaction->amount >= 0 ? 'text-success' : 'text-danger' }}">{{ $recurringTransaction->amount >= 0 ? '+ ' : '' }} {{ $recurringTransaction->amount }} €</div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 mb-3">
                        <div class="py-3">
                            <span class="text-muted">No hay transacciones recurrentes / </span><a href="{{ route('recurring_transactions.create', $account) }}" class="text-decoration-none text-light fw-bold">Crear una</a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
