@extends('layouts.app')

@section('content')
    <div id="content">
        @php
            $percent = 0;

            foreach ($account->goals as $key => $goal) {
                $percent += $goal->amount > 0 ? ($goal->contributed * 100) / $goal->amount : 0;
            }

            $totalPercent = $account->goals->count() > 0 ? $percent / $account->goals->count() : 0;
        @endphp

        <div class="row m-3 text-light mb-4">
            <div class="col-12 mt-1 text-center">
                <h1 class="fw-bold {{ $totalPercent > 0 ? 'text-success' : 'text-danger' }}">
                    {{ $totalPercent >= 0 ? '+ ' : '' }} {{ $totalPercent }} %
                </h1>
                <span>{{ $account->category->name }}</span>
            </div>
        </div>
        <div class="row text-center mt-4 pb-3">
            <div class="col-6">
                <a href="{{ route('goals.create', $account) }}" class="text-decoration-none text-white fw-bold">
                    <i class="bi bi-receipt"></i>
                    <br>
                    <small>
                        Registrar<br>
                        Objetivo
                    </small>
                </a>
            </div>
            <div class="col-6">
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
                    <h4>Objetivos</h4>
                </div>
                <div class="col-2 text-end">
                    <a class="text-decoration-none text-secondary fw-bold">
                        <i class="bi bi-search"></i><br>
                    </a>
                </div>
                <div class="col-12">
                    <small class="text-muted">Estos son tus objetivos</small>
                </div>
            </div>
            <hr>
            <div class="row px-3">
                <div id="accordionExample">
                    @forelse ($account->goals as $key => $goal)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#{{ $goal->id }}" aria-expanded="true" aria-controls="collapseOne">
                                    <div class="col-12 mb-3">
                                        <div class="py-2">
                                            <div class="row">
                                                <div class="col-6">
                                                    <b class="text-secondary">{{ $goal->name }}</b><br>
                                                    <small class="text-muted">{{ $goal->category->name }}</small>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <span class="text-white fw-bold">{{ $goal->amount > 0 ? ($goal->contributed * 100) / $goal->amount : 0 }} %</span><br>
                                                    <small>{{ $goal->end_date->format('d/m/Y') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </button>
                            </h2>
                            <div id="{{ $goal->id }}" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-12">
                                            {{ $goal->description }}
                                        </div>
                                    </div>
                                    <div class="row mb-3 mt-5">
                                        <div class="col-12 mb-3">
                                            <a href="{{ route('goals.edit', $goal) }}" class="text-decoration-none text-white fw-bold">
                                                <i class="bi bi-receipt"></i> Reutilizar objetivo
                                            </a>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <button type="submit" class="btn btn-link p-0 text-decoration-none text-white fw-bold">
                                                <i class="bi bi-file-x"></i> Registrar aporte
                                            </button>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <button type="submit" class="btn btn-link p-0 text-decoration-none text-white fw-bold">
                                                <i class="bi bi-file-x"></i> Registrar gasto
                                            </button>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <button type="submit" class="btn btn-link p-0 text-decoration-none text-white fw-bold">
                                                <i class="bi bi-file-x"></i> Retirar dinero
                                            </button>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <a href="{{ route('goals.edit', $goal) }}" class="text-decoration-none text-white fw-bold">
                                                <i class="bi bi-pencil-square"></i> Editar objetivo
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
                                <span class="text-muted">No hay objetivos registrados / </span><a href="{{ route('goals.create', $account) }}" class="text-decoration-none text-light fw-bold">Crear uno</a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
