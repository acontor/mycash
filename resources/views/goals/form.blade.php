@extends('layouts.app')

@section('content')
    <div id="content">
        <form method="POST" action="{{ $route }}">
            @method($method)
            @csrf
            <div class="m-3 mt-4 mb-5">
                <p class="text-light"><i class="bi bi-trophy me-2"></i> Persigue tu nueva meta</p>
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="form-floating mt-3 mb-3">
                                <select
                                    class="form-select @error('account_id') is-invalid @enderror"
                                    id="account_id"
                                    name="account_id"
                                    aria-label="Floating label select example"
                                >
                                    @foreach (auth()->user()->accounts->where('type', 'Objetivos') as $account)
                                        <option value="{{ $account->id }}" {{ isset($accountSelect) && $accountSelect->id == $account->id ? 'selected' : '' }}>{{ $account->name }}</option>
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
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" id="end_date" placeholder="Fecha" value="{{ old('end_date', isset($goal) ? $goal->end_date->format('Y-m-d') : now()->format('Y-m-d')) }}" required>
                                <label for="end_date">{{ __('Fecha límite') }}</label>
                                @if ($errors->has('end_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Concepto" value="{{ old('name', isset($goal) ? $goal->name : '') }}" required autofocus>
                                <label for="name">{{ __('Nombre') }}</label>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Descripción (Opcional)" name="description" id="description" style="height: 100px">{{ old('description', isset($goal) ? $goal->description : '') }}</textarea>
                                <label for="description">{{ __('Descripción') }}</label>
                            </div>
                            <div class="form-floating mb-4">
                                <select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                                    <option value="">Seleccione una categoría</option>
                                    @foreach (\App\Models\Category::where('type', 'transactions')->get() as $category)
                                        <option value="{{ $category->id }}" {{ isset($goal) && $goal->category_id === $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <label for="category_id">{{ __('Categoría') }}</label>
                                @if ($errors->has('category_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('account_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="button" class="btn btn-light btn-lg w-100" data-bs-target="#carouselExample" data-bs-slide="next">{{ __('Continuar') }}</button>
                        </div>
                        <div class="carousel-item">
                            <div class="form-floating mt-3 mb-3">
                                <input type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" id="amount" step="any" placeholder="Cantidad" value="{{ old('amount', isset($goal) ? $goal->amount : '') }}" required>
                                <label for="amount">{{ __('Objetivo') }}</label>
                                <small class="text-secondary">
                                    Añade a tu objetivo la cantidad de dinero que quieres conseguir.
                                </small>
                                @if ($errors->has('amount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control @error('contributed') is-invalid @enderror" name="contributed" id="contributed" step="any" placeholder="Cantidad" value="{{ old('contributed', isset($goal) ? $goal->contributed : '') }}" required>
                                <label for="contributed">{{ __('Aportado') }}</label>
                                <small class="text-secondary">
                                    Si ya has aportado algo a tu objetivo, es el momento de añadirlo.
                                </small>
                                @if ($errors->has('contributed'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contributed') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-floating mb-4">
                                <input type="number" class="form-control @error('spent') is-invalid @enderror" name="spent" id="spent" step="any" placeholder="Cantidad" value="{{ old('spent', isset($goal) ? $goal->spent : '') }}" required>
                                <label for="spent">{{ __('Gastado') }}</label>
                                <small class="text-secondary">
                                    Si ya has gastado algo de tu objetivo, puedes dejarlo registrado.
                                    Después, también podrás modificar esto.
                                </small>
                                @if ($errors->has('spent'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('spent') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" class="btn btn-outline-light btn-lg w-100" data-bs-target="#carouselExample" data-bs-slide="prev">{{ __('Volver') }}</button>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-light btn-lg w-100">{{ __('Aceptar') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
