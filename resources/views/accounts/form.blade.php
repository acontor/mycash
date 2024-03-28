@extends('layouts.app')

@section('content')
    <div id="content">
        <div class="m-3 mt-4 mb-5">
            <p class="text-light">Estas cuentas te ayudarán a administrar tu dinero</p>
            <form method="POST" action="{{ $route }}">
                @method($method)
                @csrf
                <div class="form-check form-switch mt-5 mb-3">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="main" @if ((isset($account) && $account->main == 1) || auth()->user()->accounts->count() == 0) checked onclick="return false;" @endif>
                    <label class="form-check-label text-light" for="flexSwitchCheckDefault">Cuenta principal</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Concepto" value="{{ old('name', isset($account) ? $account->name : '') }}" required autofocus>
                    <label for="name">{{ __('Nombre') }}</label>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Descripción (Opcional)" name="description" id="description" style="height: 100px">{{ old('description', isset($account) ? $account->description : '') }}</textarea>
                    <label for="description">{{ __('Descripción') }}</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                        <option value="">Seleccione una categoría</option>
                        @foreach (\App\Models\Category::where('type', 'accounts')->get() as $category)
                            <option value="{{ $category->id }}" {{ isset($account) && $account->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <label for="category_id">{{ __('Categoría') }}</label>
                    @if ($errors->has('category_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('category_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if ($method == 'POST')
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control @error('balance') is-invalid @enderror" name="balance" id="balance" placeholder="Saldo" step="any" value="{{ old('balance', isset($account) ? $account->balance : '') }}" required>
                        <label for="balance">{{ __('Saldo') }}</label>
                    </div>
                    @if ($errors->has('balance'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('balance') }}</strong>
                        </span>
                    @endif
                @endif
                <button type="submit" class="btn btn-light btn-lg w-100">{{ __('Aceptar') }}</button>
            </form>
        </div>
    </div>
@endsection
