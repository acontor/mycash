@extends('layouts.app')

@section('content')
    <div id="content">
        <div class="px-4 mb-5 text-white">
            <div class="row">
                <div class="col-12 mb-3">
                    <h2>{{ $moment }}</h2>
                    <p>{{ $phraseMoment }}</p>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <span class="ml-2 {{ auth()->user()->accounts->first()->balance >= 0 ? 'text-success' : 'text-danger' }}">{{ auth()->user()->accounts->first()->balance >= 0 ? '+ ' : '' }} {{ auth()->user()->accounts()->first()->balance }} €</span>
                            </h5>
                            <p class="card-text">
                                <a href="{{ route('accounts.show', auth()->user()->accounts->first()->id) }}" class="text-decoration-none text-white">
                                    <small>
                                        <i class="bi bi-piggy-bank"></i>
                                        <span class="ml-2">Cuenta Principal</span>
                                    </small>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <a href="{{ route('accounts.index') }}" class="text-decoration-none text-secondary">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <span class="ml-2 {{ auth()->user()->accounts()->sum('balance') >= 0 ? 'text-success' : 'text-danger' }}">{{ auth()->user()->accounts()->sum('balance') >= 0 ? '+ ' : '' }} {{ auth()->user()->accounts()->sum('balance') }} €</span>
                                </h5>
                                <p class="card-text text-white">
                                    <small>
                                        <i class="bi bi-bank"></i>
                                        <span class="ml-2">Patrimonio</span>
                                    </small>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row mt-4 p-3 text-center">
                <div class="col-4">
                    <small class="text-white">HOY</small>
                    <br>
                    <span class="{{ $transactionsToday < 0 ? 'text-danger' : 'text-success' }}">{{ $transactionsToday }} €</span>
                </div>
                <div class="col-4">
                    <small class="text-white">MES</small>
                    <br>
                    <span class="{{ $transactionsMonth < 0 ? 'text-danger' : 'text-success' }}">{{ $transactionsMonth }} €</span>
                </div>
                <div class="col-4">
                    <small class="text-white">AÑO</small>
                    <br>
                    <span class="{{ $transactionsYear < 0 ? 'text-danger' : 'text-success' }}">{{ $transactionsYear }} €</span>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-body text-secondary">
                    <h5 class="card-title">
                        Nuevas funciones
                    </h5>
                    <img src="{{ url("/images/announcements/share-accounts.png") }}" class="w-100 rounded mt-3" alt="Compartir cuentas">
                    <p class="card-text mt-4">¿Sabías que puedes compartir tus cuentas con las personas que quieras?</p>
                    <a href="{{ route('accounts.index') }}" class="btn btn-light">
                        <i class="bi bi-share-alt"></i>
                        <span class="ml-2">Quiero compartir</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header" data-bs-theme="dark">
                    <h1 class="modal-title fs-3 fw-bold" id="exampleModalCenteredScrollableTitle">My Cash 2.0</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¡Llega a la versión 2.0 con muchas novedades!</p>
                    <h5 class="fw-bold">COMPARTIR CUENTAS</h5>
                    <P>Empezamos por todo lo alto anunciando una de las grandes funciones de esta versión.</P>
                    <img
                        src="{{ url("/images/announcements/share-accounts.png") }}"
                        class="w-100 shadow bg-body rounded"
                        alt="Compartir cuentas"
                    >
                    <p class="mt-3">
                        A partir de ahora, podrás crear una cuenta compartida con las personas que tu decidas
                        Este tipo de cuentas pueden servir para llevar el control de los gastos de un hogar,
                        puedes utilizarla para llevar el saldo de ese viaje con tus amigos o puede ser para
                        llevar un control sobre la cuenta de tus hijos.
                    </p>
                    <p>Y, por supuesto, puedes empezar a compartir las cuentas que ya tenías creadas.</p>
                    <p>Pasemos a listar todo lo que implica esta nueva función:</p>
                    <ul>
                        <li>Crear y/o compartir una cuenta.</li>
                        <li>Ajustar los permisos de cada persona.</li>
                        <li>Incluir cuenta en el patrimonio total de tu resumen.</li>
                    </ul>
                    <p>
                        Ten en cuenta, que cuando quieran compartir una cuenta contigo, te llegará una notificación
                        para que puedas aceptarla o rechazarla. De la misma forma, cuando alguien acepte una cuenta
                        te llegará la correspondiente notificación.
                    </p>
                    <br>
                    <h5 class="fw-bold">REDISEÑO</h5>
                    <p>
                        Como habréis podido comprobar, la aplicación a pasado por chapa y pintura para ser más ahestetic
                        que nunca. Siempre intentamos resumir la interfaz para conseguir un uso más intuivo de nuestra
                        app. Pero, además de mejorar en este aspecto, hemos realizado un restilying de nuestros colores.
                    </p>
                    <div class="text-center">
                        <img
                            src="{{ url("/images/icons/icon-512x512.png") }}"
                            class="w-50 shadow bg-body rounded"
                            alt="Compartir cuentas"
                        >
                    </div>
                    <p class="mt-3">
                        Esperamos que os guste tanto como a nosotros. Pero, si no es así, siempre puedes dejarnos un
                        correo con tus sensaciones e ideas para seguir mejorando juntos.
                    </p>
                    <h5 class="fw-bold">PRÓXIMAMENTE</h5>
                    <p>
                        Ya tenemos en mente nuestras próximas funciones. En unos meses tendremos en My Cash una nueva
                        función que aún estamos estudiando y que será el perfecto complemento para la función de
                        compartir cuentas. Nos permitirá organizar aún mejor todas nuestras cuentas.
                    </p>
                    <img
                        src="{{ url("/images/announcements/workspaces.png") }}"
                        class="w-100 shadow bg-body rounded"
                        alt="Compartir cuentas"
                    >
                    <p class="mt-3">¡Aceptamos sugerencias!</p>
                </div>
            </div>
        </div>
    </div>
@endsection
