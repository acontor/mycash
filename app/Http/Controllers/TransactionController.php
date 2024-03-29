<?php

namespace App\Http\Controllers;

use App\Events\CreateActivityEvent;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TransactionController extends Controller
{
    public function __construct(
        private TransactionRepositoryInterface $transactionRepository
    ) {}

    /**
     * Display the specified resource.
     *
     * @param Transaction $transaction
     *
     * @return View
     */
    public function show(Transaction $transaction): View
    {
        $this->authorize('view', $transaction);

        return view('transactions.show', [
            'transaction' => $transaction,
            'title'       => 'Transacción',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('transactions.form', [
            'method'     => 'POST',
            'route'      => route('transactions.store'),
            'titleRight' => 'Nueva transacción',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTransactionRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreTransactionRequest $request): RedirectResponse
    {
        $transaction = $this->transactionRepository->createTransaction(
            $request->only([
                'name',
                'category_id',
                'account_id',
                'amount',
                'date',
                'description',
            ])
        );
        $this->transactionRepository->createBalanceAccount($transaction);

        event(new CreateActivityEvent(
            $transaction,
            'transaction',
            'Transacción creada',
            'Se ha creado la transacción '.$transaction->name,
            route('transactions.show', $transaction->id)
        ));
        
        return redirect()->route('accounts.show', $transaction->account_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Transaction $transaction
     *
     * @return View
     */
    public function edit(Transaction $transaction): View
    {
        $this->authorize('update', $transaction);

        return view('transactions.form', [
            'method'      => 'PUT',
            'route'       => route('transactions.update', $transaction->id),
            'titleRight'  => 'Editar transacción',
            'transaction' => $transaction,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTransactionRequest $request
     * @param Transaction              $transaction
     *
     * @return RedirectResponse
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction): RedirectResponse
    {
        $this->authorize('update', $transaction);

        $transactionData = $request->only([
            'name',
            'category_id',
            'account_id',
            'amount',
            'date',
            'description',
        ]);

        $before_amount = $transaction->amount;
        $this->transactionRepository->updateTransaction($transaction, $transactionData);
        $this->transactionRepository->updateBalanceAccount($transaction, $before_amount);

        event(new CreateActivityEvent(
            $transaction,
            'transaction',
            'Transacción actualizada',
            'Se ha actualizado la transacción '.$transaction->name,
            route('transactions.show', $transaction->id)
        ));

        return redirect()->route('accounts.show', $transaction->account_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Transaction $transaction
     *
     * @return RedirectResponse
     */
    public function destroy(Transaction $transaction): RedirectResponse
    {
        $this->authorize('delete', $transaction);

        $this->transactionRepository->deleteTransaction($transaction);
        $this->transactionRepository->deleteBalanceAccount($transaction);

        event(new CreateActivityEvent(
            $transaction,
            'transaction',
            'Transacción eliminada',
            'Se ha eliminado la transacción '.$transaction->name,
            ''
        ));

        return redirect()->route('accounts.show', $transaction->account_id);
    }
}
