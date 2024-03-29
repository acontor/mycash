@extends('layouts.app')

@section('head')
    <style>
        [name=falseIcon] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* IMAGE STYLES */
        [name=falseIcon] + i {
            cursor: pointer;
        }

        /* CHECKED STYLES */
        [name=falseIcon]:checked + i {
            color: #580eeb;
            border-bottom: 1px solid #580eeb;
        }
    </style>
@endsection

@section('content')
    <div id="content">
        <div class="m-3 mt-4 mb-5">
            <p class="text-light mb-5">Categorizar tus gastos y cuentas ayudará a tener una vista general de tu economía</p>
            <form method="POST" action="{{ $route }}">
                @method($method)
                @csrf
                <input type="hidden" name="color" id="color" value="{{ old('color', isset($category) ? $category->color : '') }}">
                <input type="hidden" name="icon" id="icon" value="{{ old('icon', isset($category) ? $category->icon : '') }}">
                <div class="row justify-content-center">
                    <div class=" col-2 text-center text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i
                            class="{{ old('icon', isset($category) ? $category->icon : 'bi bi-plus-circle-fill') }} fs-1 px-2 py-1 rounded-2"
                            style="background-color: {{ old('color', isset($category) ? $category->color : '#580eeb') }};"
                            id="view-icon"
                        ></i>
                    </div>
                </div>
                <div class="form-floating mt-5 mb-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Concepto" value="{{ old('name', isset($category) ? $category->name : '') }}" required autofocus>
                        <label for="name">{{ __('Nombre') }}</label>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                @if (isset($category))
                    <div class="form-floating mb-3">
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" aria-label="Floating label select example" disabled>
                            <option>{{ $category->type }}</option>
                        </select>
                        <label for="type">{{ __('Categoría') }}</label>
                    </div>
                @else
                    <div class="form-floating mb-3">
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" aria-label="Floating label select example">
                            <option value="Cuentas" {{ $type === 'Cuentas' ? 'selected' : '' }}>Cuentas</option>
                            <option value="Objetivos" {{ $type === 'Objetivos' ? 'selected' : '' }}>Objetivos</option>
                            <option value="Transacciones" {{ $type === 'Transacciones' ? 'selected' : '' }}>Transacciones</option>
                        </select>
                        <label for="type">{{ __('Categoría') }}</label>
                        @if ($errors->has('type'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('type') }}</strong>
                            </span>
                        @endif
                    </div>
                @endif
                @if(isset($category))
                    <div class="row">
                        <div class="col-6">
                            <form method="POST" class="delete" action="{{ route('categories.destroy', $category->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-lg w-100">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-light btn-lg w-100">{{ __('Aceptar') }}</button>
                        </div>
                    </div>
                @else
                    <button type="submit" class="btn btn-light btn-lg w-100">{{ __('Aceptar') }}</button>
                @endif
            </form>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-white text-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Color/Icono</h1>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-1 text-center">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="falseColor" id="falseColor" value="#580EEB" style="background-color: #580EEB; border-color: #580EEB" {{ (old('color', isset($category) ? $category->color : '') === "#580EEB" || old('color') === null) ? 'checked' : '' }}>
                            </div>
                        </div>
                        <div class="col-1 text-center">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="falseColor" id="falseColor" value="#000" style="background-color: #000; border-color: #000" {{ old('color', isset($category) ? $category->color : '') === "#000" ? 'checked' : '' }}>
                            </div>
                        </div>
                        <div class="col-1 text-center">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="falseColor" id="falseColor" value="#eb1d0e" style="background-color: #eb1d0e; border-color: #eb1d0e" {{ old('color', isset($category) ? $category->color : '') === "#eb1d0e" ? 'checked' : '' }}>
                            </div>
                        </div>
                        <div class="col-1 text-center">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="falseColor" id="falseColor" value="#0eeb33" style="background-color: #0eeb33; border-color: #0eeb33" {{ old('color', isset($category) ? $category->color : '') === "#0eeb33" ? 'checked' : '' }}>
                            </div>
                        </div>
                        <div class="col-1 text-center">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="falseColor" id="falseColor" value="#e7eb0e" style="background-color: #e7eb0e; border-color: #e7eb0e" {{ old('color', isset($category) ? $category->color : '') === "#e7eb0e" ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-4">
                        <div class="col-2 text-center">
                            <div class="form-check ps-1">
                                <label>
                                    <input type="radio" name="falseIcon" id="falseIcon" value="bi bi-bag" {{ old('icon', isset($category) ? $category->icon : '') === "bi bi-bag" ? 'checked' : '' }}>
                                    <i class="bi bi-bag fs-1"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-2 text-center">
                            <div class="form-check ps-1">
                                <label>
                                    <input type="radio" name="falseIcon" id="falseIcon" value="bi bi-cart-dash" {{ old('icon', isset($category) ? $category->icon : '') === "bi bi-cart-dash" ? 'checked' : '' }}>
                                    <i class="bi bi-cart-dash fs-1"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-2 text-center">
                            <div class="form-check ps-1">
                                <label>
                                    <input type="radio" name="falseIcon" id="falseIcon" value="bi bi-0-square" {{ old('icon', isset($category) ? $category->icon : '') === "bi bi-0-square" ? 'checked' : '' }}>
                                    <i class="bi bi-0-square fs-1"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-2 text-center">
                            <div class="form-check ps-1">
                                <label>
                                    <input type="radio" name="falseIcon" id="falseIcon" value="bi bi-activity" {{ old('icon', isset($category) ? $category->icon : '') === "bi bi-activity" ? 'checked' : '' }}>
                                    <i class="bi bi-activity fs-1"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-2 text-center">
                            <div class="form-check ps-1">
                                <label>
                                    <input type="radio" name="falseIcon" id="falseIcon" value="bi bi-airplane-engines" {{ old('icon', isset($category) ? $category->icon : '') === "bi bi-airplane-engines" ? 'checked' : '' }}>
                                    <i class="bi bi-airplane-engines fs-1"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('input[type=radio][name=falseIcon]').change(function() {
                icon = this.value

                $('#icon').val(icon)
                $('#view-icon').attr('class', icon+' fs-1 px-2 py-1 rounded-2')

            });

            $('input[type=radio][name=falseColor]').change(function() {
                color = this.value

                $('#color').val(color)
                $('#view-icon').attr('style', 'background-color: '+color)
            });
        });
    </script>
@endsection
