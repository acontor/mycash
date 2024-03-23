@extends('layouts.app')

@section('content')
    <div id="content">
        <div class="m-3 mt-4 mb-5">
            <h1 class="fw-bold text-light">{{ $method == 'POST' ? 'Nueva' : 'Editar' }} transacción</h1>
            <p class="text-light">LLeva un control de tus movimientos</p>
            <form method="POST" action="{{ $route }}">
                @method($method)
                @csrf
                <div class="form-floating mt-5 mb-3">
                    <select class="form-select @error('account_id') is-invalid @enderror" id="account_id" name="account_id" aria-label="Floating label select example">
                        @foreach (auth()->user()->accounts as $account)
                            <option value="{{ $account->id }}" {{ isset($transaction) && $transaction->account_id == $account->id ? 'selected' : (auth()->user()->accounts->first()->id == $account->id ? 'selected' : '') }}>{{ $account->name }} · Saldo {{ $account->balance }}</option>
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
                    <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" id="date" placeholder="Fecha" value="{{ old('date', isset($transaction) ? $transaction->date->format('Y-m-d') : now()->format('Y-m-d')) }}" required>
                    <label for="date">{{ __('Fecha') }}</label>
                    @if ($errors->has('date'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('date') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Concepto" value="{{ old('name', isset($transaction) ? $transaction->name : '') }}" required autofocus>
                    <label for="name">{{ __('Nombre') }}</label>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Descripción (Opcional)" name="description" id="description" style="height: 100px">{{ old('description', isset($transaction) ? $transaction->description : '') }}</textarea>
                    <label for="description">{{ __('Descripción') }}</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                        <option value="">Seleccione una categoría</option>
                        @foreach (\App\Models\Category::where('type', 'transactions')->get() as $category)
                            <option value="{{ $category->id }}" {{ isset($transaction) && $transaction->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <label for="category_id">{{ __('Categoría') }}</label>
                    @if ($errors->has('category_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('category_id') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-floating mb-4">
                    <input type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" id="amount" step="any" placeholder="Cantidad" value="{{ old('amount', isset($transaction) ? $transaction->amount : '') }}" required>
                    <label for="amount">{{ __('Cantidad') }}</label>
                    @if ($errors->has('amount'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('amount') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-light btn-lg w-100">{{ __('Aceptar') }}</button>
            </form>
        </div>
    </div>
@endsection
