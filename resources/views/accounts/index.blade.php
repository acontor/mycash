@extends('layouts.app')

@section('content')
    <div id="navbar-top" class="card fixed-top">
        <div class="card-body">
            <span class="page-title float-end">Cuentas</span>
        </div>
    </div>
    <div class="row text-center mt-3 pb-3">
        <div class="col-12">
            <a href="{{ route('accounts.create') }}" class="text-decoration-none text-white fw-bold">
                <i class="bi bi-wallet2"></i>
                <br>Nueva
                <br>Cuenta
            </a>
        </div>
    </div>
    <div class="card m-3">
        <div class="card-body">
            <div class="row">
                @foreach ($accounts as $index => $account)
                    @if ($index > 0)
                        <div class="col-12">
                            <hr>
                        </div>
                    @endif
                    <div class="col-12">
                        <a href="{{ route('accounts.show', $account->id) }}" class="text-decoration-none text-secondary">
                            <div class="py-3">
                                <b class="text-dark">{{ $account->name }}</b>
                                <div class="float-end {{ $account->balance >= 0 ? 'text-success' : 'text-danger' }}">{{ $account->balance >= 0 ? '+ ' : '' }} {{ $account->balance }} €</div>
                                <br>{{ $account->description }}
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
