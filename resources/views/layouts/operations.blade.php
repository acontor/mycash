<div
    class="offcanvas offcanvas-bottom h-100 bg-primary"
    tabindex="-1"
    id="offcanvasOperations"
    aria-labelledby="offcanvasOperationsLabel"
    data-bs-backdrop="true"
>
    <div class="offcanvas-header">
        <p></p>
        <h2 class="text-white" id="offcanvasOperationsLabel">Operaciones</h2>
    </div>
    <div class="offcanvas-body small">
        <div class="row text-center">
            <div class="col-6 mb-5 mt-5">
                <a href="{{ route('transactions.create') }}" class="text-decoration-none text-white">
                    <i class="bi bi-receipt"></i>
                    <br>Registrar
                    <br>Transacción
                </a>
            </div>
            <div class="col-6 mb-5 mt-5">
                <a href="{{ route('recurring_transactions.create') }}" class="text-decoration-none text-white">
                    <i class="bi bi-receipt"></i>
                    <br>Crear
                    <br>Transacción Recurrente
                </a>
            </div>
            <div class="col-6 mb-5">
                <a href="{{ route('accounts.create') }}" class="text-decoration-none text-white">
                    <i class="bi bi-wallet2"></i>
                    <br>Nueva
                    <br>Cuenta
                </a>
            </div>
            <div class="col-6 mb-5">
                <a href="#" class="text-decoration-none text-white disabled">
                    <i class="bi bi-share"></i>
                    <br>Compartir
                    <br>Cuenta
                    <br><small>(Próximamente)</small>
                </a>
            </div>
            <div class="col-6 mb-5">
                <a href="#" class="text-decoration-none text-white disabled">
                    <i class="bi bi-award"></i>
                    <br>Nueva
                    <br>Meta
                    <br><small>(Próximamente)</small>
                </a>
            </div>
            <div class="col-6 mb-5">
                <a href="#" class="text-decoration-none text-white">
                    <i class="bi bi-journal-text"></i>
                    <br>Nuevo
                    <br>Informe
                    <br><small>(Próximamente)</small>
                </a>
            </div>
        </div>
    </div>
    <div class="offcanvas-footer text-center bg-primary pb-3">
        <button
            type="button"
            class="offcanvas-title btn no-btn-secondary fs-5"
            data-bs-dismiss="offcanvas"
            aria-label="Close"
        >
            <i class="bi bi-caret-down-fill"></i>
        </button>
    </div>
</div>