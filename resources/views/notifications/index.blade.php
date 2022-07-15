@extends('layouts.app')

@section('content')
    <div class="mt-3 pb-4">
        <div id="navbar-top" class="card fixed-top">
            <div class="card-body">
                <span class="page-title float-end">Notificaciones</span>
            </div>
        </div>
        @if ($notifications->where('priority', 1)->count() > 0)
            <div class="card">
                <div class="card-body">
                    <h5 class="my-2">Compartir cuenta</h5>
                    <div class="row">
                        @foreach ($notifications->where('priority', 1) as $account)
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12">
                                <a href="{{ route('shares.edit', $account) }}" class="text-decoration-none text-secondary">
                                    <div class="py-2">
                                        <div class="row">
                                            <div class="col-6">
                                                {{ $account->name }}<br>
                                                <small class="text-muted">{{ substr($account->description, 0, 20) }}</small>
                                            </div>
                                            <div class="col-6 text-end">
                                                {{ $account->users()->wherePivot('is_owner', true)->first()->name }}<br>
                                                {{ $account->users()->wherePivot('is_owner', false)->first()->created_at->format('d/m/Y') }}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <div class="card mx-3">
            <div class="card-body">
                <div class="row">
                    @forelse ($notifications->where('priority', 0) as $key => $notification)
                        @if ($key > 0)
                            <div class="col-12">
                                <hr>
                            </div>
                        @endif
                        <div class="col-12">
                            <a href="{{ $notification->action }}" class="text-decoration-none text-dark">
                                <h5 class="my-2">{{ $notification->name }}</h5>
                                <div class="py-2">
                                    <small class="text-muted">{{ $notification->description }}.</small>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12">
                            <h5 class="my-2">No hay notificaciones</h5>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
