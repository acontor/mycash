@extends('layouts.app')

@section('content')
    <div id="content">
        <div class="px-4 mb-5 text-white">
            <div class="row">
                <h1>Oh no!</h1>
                <p>No se como llegaste aquí, pero no vuelvas a hacerlo. Vuelve a <a class="text-white" href="{{ '/home' }}">casa</a>.</p>
            </div>
        </div>
    </div>
@endsection
