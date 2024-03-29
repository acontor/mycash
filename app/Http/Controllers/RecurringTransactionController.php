<?php

namespace App\Http\Controllers;

use App\Events\CreateActivityEvent;
use App\Http\Requests\StoreRecurringTransactionRequest;
use App\Http\Requests\UpdateRecurringTransactionRequest;
use App\Interfaces\RecurringTransactionRepositoryInterface;
use App\Models\Account;
use App\Models\RecurringTransaction;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RecurringTransactionController extends Controller
{
    public function __construct(
        private RecurringTransactionRepositoryInterface $recurringTransactionRepository
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @param Account $account
     *
     * @return View
     */
    public function index(Account $account)
    {
        $this->authorize('viewNormal', $account);

        return view('recurring-transactions.index', [
            'account'               => $account,
            'previous'              => true,
            'recurringTransactions' => $this->recurringTransactionRepository->getAllRecurringTransactions($account),
            'titleRight'            => $account->name,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param RecurringTransaction $recurringTransaction
     *
     * @return View
     */
    public function show(RecurringTransaction $recurringTransaction): View
    {
        $this->authorize('view', $recurringTransaction);

        return view('recurring-transactions.show', [
            'recurringTransaction' => $recurringTransaction,
            'title'                => 'Transacciones',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(Account $account)
    {
        return view('recurring-transactions.form', [
            'account'    => $account,
            'method'     => 'POST',
            'route'      => route('recurring_transactions.store', $account),
            'title'      => 'Transacciones',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRecurringTransactionRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreRecurringTransactionRequest $request): RedirectResponse
    {
        $recurringTransaction = $this->recurringTransactionRepository->createRecurringTransaction(
            $request->only([
                'account_id',
                'category_id',
                'name',
                'description',
                'frequency',
                'amount',
                'start_date',
                'remaining',
            ])
        );

        event(new CreateActivityEvent(
            $recurringTransaction,
            'recurring_transaction',
            'Transacción recurrente creada',
            'Se ha creado la transacción ' . $recurringTransaction->name,
            '/recurring_transactions/' . $recurringTransaction->id
        ));
        
        return redirect()->route('recurring_transactions.index', $recurringTransaction->account_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param RecurringTransaction $recurringTransaction
     *
     * @return View
     */
    public function edit(RecurringTransaction $recurringTransaction): View
    {
        $this->authorize('update', $recurringTransaction);

        return view('recurring-transactions.form', [
            'method'               => 'PUT',
            'recurringTransaction' => $recurringTransaction,
            'route'                => route('recurring_transactions.update', $recurringTransaction->id),
            'title'                => 'Transacciones',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRecurringTransactionRequest $request
     * @param  RecurringTransaction              $recurringTransaction
     *
     * @return RedirectResponse
     */
    public function update(
        UpdateRecurringTransactionRequest $request,
        RecurringTransaction $recurringTransaction
    ): RedirectResponse {
        $this->authorize('update', $recurringTransaction);

        $this->recurringTransactionRepository->updateRecurringTransaction(
            $recurringTransaction,
            $request->only([
                'category_id',
                'name',
                'description',
                'amount',
            ])
        );

        event(new CreateActivityEvent(
            $recurringTransaction,
            'recurring_transaction',
            'Transacción recurrente actualizada',
            'Se ha actualizado la transacción ' . $recurringTransaction->name,
            '/recurring_transactions/' . $recurringTransaction->id)
        );
        
        return redirect()->route('recurring_transactions.index', $recurringTransaction->account_id);
    }
}
