@extends('layouts.app')

@section('content')
    <div id="navbar-top" class="card fixed-top">
        <div class="card-body">
            <a href="{{ url()->previous() }}" class="text-secondary text-decoration-none"><</a>
            <span class="page-title float-end">Transacción</span>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-4">
            <a href="{{ route('transactions.edit', $transaction) }}" class="text-decoration-none text-white fw-bold">
                <i class="bi bi-receipt"></i><br>
                Reutilizar<br>
                Transacción
            </a>
        </div>
        <div class="col-4">
            <form method="POST" class="delete" action="{{ route('transactions.destroy', $transaction->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-link p-0 text-decoration-none text-white fw-bold">
                    <i class="bi bi-file-x"></i><br>
                    Eliminar<br>
                    Transacción
                </button>
            </form>
        </div>
        <div class="col-4">
            <a href="{{ route('transactions.edit', $transaction) }}" class="text-decoration-none text-white fw-bold">
                <i class="bi bi-pencil-square"></i><br>
                Editar<br>
                Transacción
            </a>
        </div>
    </div>
    <div class="card m-3 mt-4">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h5>{{ $transaction->name }}</h5>
                    <small>{{ $transaction->description }}</small>
                </div>
                <div class="col-12">
                    <hr>
                </div>
                <div class="col-12">
                    Cantidad
                    <span class="float-end {{ $transaction->amount >= 0 ? 'text-success' : 'text-danger' }}">{{ $transaction->amount }} €</span>
                </div>
                <div class="col-12 mt-3">
                    Fecha de la operación
                    <span class="float-end">{{ $transaction->date->format('d/m/Y') }}</span>
                </div>
                <div class="col-12 mt-3">
                    Categoría
                    <span class="float-end">{{ $transaction->category->name }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.delete').submit(function() {
                return confirm('¿Estás seguro de eliminar esta transacción?');
            });
        });
    </script>
@endsection
