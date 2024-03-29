@extends('layouts.app')

@section('content')
    <div id="content">
        <div class="m-3 mt-4 mb-5">
            <p class="text-light mb-5">
                Tus cuentas te ayudarán a administrar tu dinero, ver crecer tus ahorros o cumplir tus objetivos
            </p>
            <form method="POST" action="{{ $route }}">
                @method($method)
                @csrf
                @if (!isset($account))
                    <div class="form-floating mb-3">
                        <select class="form-control @error('type') is-invalid @enderror" name="type" id="type">
                            <option value="">{{ __('Seleccione un tipo') }}</option>
                            <option
                                value="Normal" {{ old('type') === 'Normal' ? 'selected' : '' }}
                            >{{ __('Normal') }}</option>
                            <option
                                value="Objetivos" {{ old('type') === 'Objetivos' ? 'selected' : '' }}
                            >{{ __('Objetivos') }}</option>
                        </select>
                        <label for="type">{{ __('Tipo') }}</label>
                        @if ($errors->has('type'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('type') }}</strong>
                            </span>
                        @endif
                    </div>
                @endif
                <div class="form-check form-switch mb-3 normal">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="main"
                        name="main"
                        @if ((isset($account) && $account->main == 1) || auth()->user()->accounts->count() == 0)
                            checked onclick="return false;"
                        @endif
                    >
                    <label class="form-check-label text-light" for="main">{{ __('Cuenta principal') }}</label>
                </div>
                <div class="form-floating mb-3 normal objetivos">
                    <input
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        name="name"
                        id="name"
                        placeholder="Concepto"
                        value="{{ old('name', isset($account) ? $account->name : '') }}"
                        required
                        autofocus
                    >
                    <label for="name">{{ __('Nombre') }}</label>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-floating mb-3 normal objetivos">
                    <textarea
                        class="form-control"
                        placeholder="Descripción (Opcional)"
                        name="description"
                        id="description"
                        style="height: 100px"
                    >{{ old('description', isset($account) ? $account->description : '') }}</textarea>
                    <label for="description">{{ __('Descripción') }}</label>
                </div>
                <div class="form-floating mb-3 normal objetivos">
                    <select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                        <option value="">{{ __('Seleccione una categoría') }}</option>
                        @foreach (\App\Models\Category::where('type', 'accounts')->get() as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id', isset($account) ? $account->category_id : '') == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>
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
                    <div class="form-floating mb-3 normal">
                        <input
                            type="number"
                            class="form-control @error('balance') is-invalid @enderror"
                            name="balance"
                            id="balance"
                            placeholder="Saldo"
                            step="any"
                            value="{{ old('balance', isset($account) ? $account->balance : '') }}"
                            required
                        >
                        <label for="balance">{{ __('Saldo') }}</label>
                    </div>
                    @if ($errors->has('balance'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('balance') }}</strong>
                        </span>
                    @endif
                @endif
                <button
                    type="submit"
                    class="btn btn-light btn-lg w-100 normal objetivos"
                >
                    {{ __('Aceptar') }}
                </button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    @if (!isset($account))
        <script>
            $(document).ready(function() {
                miFuncion();

                $('#type').change(function() {
                    miFuncion();
                });
            });

            function miFuncion() {
                let seleccion = $('#type').val();

                $('.normal').addClass('d-none');

                if ('Normal' === seleccion) {
                    $('.normal').removeClass('d-none');
                    $('#balance').prop('required', true);
                } else if('Objetivos' === seleccion) {
                    $('.objetivos').removeClass('d-none');
                    $('#balance').val(0);
                    $('#balance').prop('required', false);
                    $('#main').prop('checked', false);
                }
            }
        </script>
    @endif
@endsection