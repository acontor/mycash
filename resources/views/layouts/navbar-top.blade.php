@isset($title)
    <div id="navbar-top" class="card fixed-top bg-primary">
        <div class="card-body">
            @isset($previous)
                <a href="{{ url()->previous() }}" class="text-secondary text-decoration-none fs-5"><</a>
            @endisset
            <h2 class="page-title float-end text-white">{{ $title }}</h2>
        </div>
    </div>
@endisset