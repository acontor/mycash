@extends('layouts.app')

@section('content')
    <div id="content">
        <div class="row text-center mt-3 pb-3">
            <div class="col-12">
                <a href="{{ route('accounts.create') }}" class="text-decoration-none text-white fw-bold">
                    <i class="bi bi-wallet2"></i>
                    <br>
                    <small>
                        Nueva
                        <br>Cuenta
                    </small>
                </a>
            </div>
        </div>
        <div class="card m-3">
            <div class="card-body text-white">
                <div class="row mt-3">
                    <div class="col-12">
                        <h4>Cuentas</h4>
                    </div>
                    <div class="col-12 mb-4">
                        <small class="text-muted">Lleva el control de tus gastos</small>
                    </div>
                    <hr>
                    @foreach ($accounts as $index => $account)
                        <div class="col-12">
                            <a href="{{ route('accounts.show', $account->id) }}" class="text-decoration-none text-secondary">
                                <div class="py-3">
                                    <b class="text-secondary">{{ $account->name }}</b>
                                    <div class="float-end {{ $account->balance >= 0 ? 'text-success' : 'text-danger' }}">{{ $account->balance >= 0 ? '+ ' : '' }} {{ $account->balance }} €</div>
                                    <br>
                                    <span class="text-muted">{{ $account->description }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card m-3">
            <div class="card-body text-white">
                <div class="row mt-3">
                    <div class="col-12">
                        <h4>Cuentas Objetivo</h4>
                    </div>
                    <div class="col-12 mb-4">
                        <small class="text-muted">Persigue tus objetivos</small>
                    </div>
                    <hr>
                    @foreach ($accounts as $index => $account)
                        <div class="col-12">
                            <a href="{{ route('accounts.show', $account->id) }}" class="text-decoration-none text-secondary">
                                <div class="py-3">
                                    <b class="text-secondary">{{ $account->name }}</b>
                                    <div class="float-end {{ $account->balance >= 0 ? 'text-success' : 'text-danger' }}">{{ $account->balance >= 0 ? '+ ' : '' }} {{ $account->balance }} €</div>
                                    <br>
                                    <span class="text-muted">{{ $account->description }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
