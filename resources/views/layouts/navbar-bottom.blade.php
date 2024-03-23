@if (auth()->user()->accounts->count() > 0 and !isset($previous))
    <nav class="navbar fixed-bottom navbar-light bg-primary pb-4">
        <div class="container-fluid d-flex justify-content-evenly text-center">
            <a
                href="{{ route('home') }}"
                class="{{ Route::currentRouteName() === 'home' ? 'text-secondary' : 'text-white' }}"
            >
                <i class="bi bi-house fs-4"></i>
            </a>
            <a
                href="{{ route('accounts.index') }}"
                class="{{ Route::currentRouteName() === 'accounts.index' ? 'text-secondary' : 'text-white' }}"
            >
                <i class="bi bi-wallet-fill fs-4"></i>
            </a>
            <a
                class="text-decoration-none text-white"
                data-bs-toggle="offcanvas"
                href="#offcanvasOperations"
                role="button" aria-controls="offcanvasOperations"
            ><i class="bi bi-patch-plus fs-4"></i></a>
            <a
                href="{{ route('activities.index') }}"
                class="{{ Route::currentRouteName() === 'activities.index' ? 'text-secondary' : 'text-white' }}"
            >
                <i class="bi bi-clock-history fs-4"></i>
            </a>
            <a
                class="text-decoration-none text-white"
                data-bs-toggle="offcanvas"
                href="#offcanvasMenu"
                role="button"
                aria-controls="offcanvasMenu"
            >
                <i class="bi bi-list fs-4"></i>
            </a>
        </div>
    </nav>
@endif