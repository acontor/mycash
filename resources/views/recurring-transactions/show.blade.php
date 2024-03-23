@extends('layouts.app')

@section('content')
    <div id="content">
        <div class="row text-center mt-4 mb-5">
            <div class="col-12">
                @if ($recurringTransaction->active)
                    <a href="{{ route('recurring_transactions.edit', $recurringTransaction) }}" class="text-decoration-none text-white fw-bold">
                        <i class="bi bi-pencil-square"></i><br>
                        Editar<br>
                        Transacción
                    </a>
                @else
                    <a href="" class="text-decoration-none text-white fw-bold">
                        <i class="bi bi-receipt"></i><br>
                        Reutilizar<br>
                        Transacción
                    </a>
                @endif
            </div>
        </div>
        <div class="card m-3 mt-4 text-secondary">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h5>{{ $recurringTransaction->name }}</h5>
                        <small class="text-muted">{{ $recurringTransaction->description }}</small>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12">
                        Categoría
                        <span class="float-end">{{ $recurringTransaction->category->name }}</span>
                    </div>
                    <div class="col-12 mt-3">
                        Fecha de la operación
                        <span class="float-end">{{ $recurringTransaction->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="col-12 mt-3">
                        Día de cobro
                        <span class="float-end">{{ $recurringTransaction->created_at->format('d') }}</span>
                    </div>
                    <div class="col-12 mt-3">
                        Frecuencia en meses
                        <span class="float-end">{{ $recurringTransaction->frequency }}</span>
                    </div>
                    @if ($recurringTransaction->remaining > 0)
                        <div class="col-12 mt-3">
                            Pagos restantes
                            <span class="float-end">{{ $recurringTransaction->remaining }}</span>
                        </div>
                    @endif
                    <div class="col-12 mt-3">
                        Cantidad
                        <span class="float-end">{{ $recurringTransaction->amount }} €</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

