@extends('layouts.app')

@section('content')
    <div id="content">
        <div class="px-4 mb-5 text-white">
            <div class="row">
                <h1>Oh no!</h1>
                <p>Parece que te has perdido, pero puedes volver <a class="text-white" href="{{ URL::previous() }}">atrás</a>.</p>
            </div>
        </div>
    </div>
@endsection
