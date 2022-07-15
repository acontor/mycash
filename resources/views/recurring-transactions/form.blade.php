@extends('layouts.app')

@section('content')
    <div id="navbar-top" class="card fixed-top">
        <div class="card-body">
            <a href="{{ url()->previous() }}" class="text-secondary text-decoration-none"><</a>
            <span class="page-title float-end">Transacciones recurrentes</span>
        </div>
    </div>
    <div class="m-3 mt-4">
        <h1 class="fw-bold text-light">{{ $method == 'POST' ? 'Nueva': 'Editar' }} transacción recurrente</h1>
        <p class="text-light">Tus transacciones recurrentes existen para ahorrarte tiempo</p>
        <form method="POST" action="{{ $route }}">
            @method($method)
            @csrf
            @if ($method == 'POST')
                <div class="form-floating mt-4 mb-3">
                    <select class="form-select @error('account_id') is-invalid @enderror" id="account_id" name="account_id" aria-label="Floating label select example">
                        @foreach (auth()->user()->accounts as $item)
                            <option value="{{ $item->id }}" {{ $account->id == $item->id ? 'selected' : '' }}>{{ $item->name }} · Saldo {{ $item->balance }}</option>
                        @endforeach
                    </select>
                    <label for="account_id">{{ __('Cuenta') }}</label>
                    @if ($errors->has('account_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('account_id') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-floating mb-3">
                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" placeholder="Fecha de inicio" value="{{ old('start_date') ?? now()->format('Y-m-d') }}" required>
                    <label for="start_date">{{ __('Fecha de inicio') }}</label>
                    @if ($errors->has('start_date'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('start_date') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control @error('remaining') is-invalid @enderror" name="remaining" placeholder="Número de pagos (Opcional)" value="{{ old('remaining') }}" autofocus>
                    <label for="end_date">{{ __('Número de pagos (Opcional)') }}</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('frequency') is-invalid @enderror" name="frequency" placeholder="Frecuencia" value="{{ old('frequency') }}" required>
                    <label for="frequency">{{ __('Frecuencia') }}</label>
                    @if ($errors->has('frequency'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('frequency') }}</strong>
                        </span>
                    @endif
                </div>
            @endif
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Concepto" value="{{ old('name', isset($recurringTransaction) ? $recurringTransaction : '') }}" required>
                <label for="name">{{ __('Nombre') }}</label>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Descripción (Opcional)" name="description" style="height: 100px">{{ old('description', isset($recurringTransaction) ? $recurringTransaction->description : '' )}}</textarea>
                <label for="description">{{ __('Descripción') }}</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                    <option value="">Seleccione una categoría</option>
                    @foreach (\App\Models\Category::where('type', 'transactions')->get() as $category)
                        <option value="{{ $category->id }}" {{ isset($recurringTransaction) && $recurringTransaction->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                <label for="category_id">{{ __('Categoría') }}</label>
                @if ($errors->has('category_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('account_id') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-floating mb-4">
                <input type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" placeholder="Cantidad" value={{ old('amount', isset($recurringTransaction) ? $recurringTransaction->amount : '' )}} required>
                <label for="amount">{{ __('Cantidad') }}</label>
                @if ($errors->has('amount'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('account_id') }}</strong>
                    </span>
                @endif
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-block">{{ __('Aceptar') }}</button>
            </div>
        </form>
    </div>
@endsection
