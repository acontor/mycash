@extends('layouts.app')

@section('content')
    <div id="content">
        <div class="row m-3 text-light mb-4">
            <div class="col-12 mt-1 text-center">
                <h1 class="fw-bold {{ $account->balance >= 0 ? 'text-success' : 'text-danger' }}">{{ $account->balance >= 0 ? '+ ' : '' }} {{ $account->balance }} €</h1>
                <span>{{ $account->category->name }}</span>
            </div>
        </div>
        <div class="row text-center mt-4 pb-3">
            <div class="col-4">
                <a href="{{ route('transactions.create') }}" class="text-decoration-none text-white fw-bold">
                    <i class="bi bi-receipt"></i>
                    <br>
                    <small>
                        Registrar<br>
                        Transacción
                    </small>
                </a>
            </div>
            <div class="col-4">
                <a href="{{ route('recurring_transactions.index', $account) }}" class="text-decoration-none text-white fw-bold">
                    <i class="bi bi-receipt"></i>
                    <br>
                    <small>
                        Transacciones<br>
                        Recurrentes
                    </small>
                </a>
            </div>
            <div class="col-4">
                <a href="{{ route('accounts.edit', $account) }}" class="text-decoration-none text-white fw-bold">
                    <i class="bi bi-pencil-square"></i>
                    <br>
                    <small>
                        Editar<br>
                        Cuenta
                    </small>
                </a>
            </div>
        </div>
        <div class="card m-3 text-secondary">
            <div class="row px-3 mt-3">
                <div class="col-10">
                    <h4>Transacciones</h4>
                </div>
                <div class="col-2 text-end">
                    <a class="text-decoration-none text-secondary fw-bold">
                        <i class="bi bi-search"></i><br>
                    </a>
                </div>
                <div class="col-12">
                    <small class="text-muted">Últimas transacciones de tu cuenta</small>
                </div>
            </div>
            <hr>
            <div class="row px-3">
                <div id="accordionExample">
                    @forelse ($account->transactions as $key => $transaction)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#{{ $transaction->id }}" aria-expanded="true" aria-controls="collapseOne">
                                    <div class="col-12 mb-3">
                                        <div class="py-2">
                                            <div class="row">
                                                <div class="col-6">
                                                    <b class="text-secondary">{{ $transaction->name }}</b><br>
                                                    <small class="text-muted">{{ $transaction->category->name }}</small>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <span class="{{ $transaction->amount >= 0 ? 'text-success' : 'text-danger' }}">{{ $transaction->amount }} €</span><br>
                                                    <small>{{ $transaction->created_at->format('d/m/Y') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </button>
                            </h2>
                            <div id="{{ $transaction->id }}" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-12">
                                            {{ $transaction->description }}
                                        </div>
                                    </div>
                                    <div class="row mb-3 mt-5">
                                        <div class="col-12 mb-3">
                                            <a href="{{ route('transactions.edit', $transaction) }}" class="text-decoration-none text-white fw-bold">
                                                <i class="bi bi-receipt"></i> Reutilizar transacción
                                            </a>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <form method="POST" class="delete" action="{{ route('transactions.destroy', $transaction->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link p-0 text-decoration-none text-white fw-bold">
                                                    <i class="bi bi-file-x"></i> Eliminar transacción
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <a href="{{ route('transactions.edit', $transaction) }}" class="text-decoration-none text-white fw-bold">
                                                <i class="bi bi-pencil-square"></i> Editar transacción
                                            </a>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 mb-3">
                            <div class="py-3">
                                <span class="text-muted">No hay transacciones registradas / </span><a href="{{ route('transactions.create', $account) }}" class="text-decoration-none text-light fw-bold">Crear una</a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
