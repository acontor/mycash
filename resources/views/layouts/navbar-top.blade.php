@isset($title)
    <div id="navbar-top" class="card fixed-top bg-primary">
        <div class="card-body">
            @isset($previous)
                <a href="{{ url()->previous() }}" class="text-secondary text-decoration-none h2">
                    <i class="bi bi-arrow-left-short"></i>
                </a>
            @endisset
            <h2 class="page-title float-end text-white">{{ $title }}</h2>
        </div>
    </div>
@endisset