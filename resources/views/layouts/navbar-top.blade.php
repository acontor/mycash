@isset($titleRight)
    <div id="navbar-top" class="card fixed-top bg-transparent">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h1
                        class="page-title float-end fw-bold text-white"
                        {{ $titleRight === 'My Cash' ? 'data-bs-toggle=modal data-bs-target=#staticBackdrop' : '' }}
                    >{{ $titleRight }}</h1>
                </div>
            </div>
        </div>
    </div>
@endisset
