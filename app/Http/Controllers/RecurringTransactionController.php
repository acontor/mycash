<?php

namespace App\Http\Controllers;

use App\Events\ActivityEvent;
use App\Http\Requests\StoreRecurringTransactionRequest;
use App\Http\Requests\UpdateRecurringTransactionRequest;
use App\Interfaces\RecurringTransactionRepositoryInterface;
use App\Models\Account;
use App\Models\RecurringTransaction;

class RecurringTransactionController extends Controller
{
    private RecurringTransactionRepositoryInterface $recurringTransactionRepository;

    public function __construct(RecurringTransactionRepositoryInterface $recurringTransactionRepository)
    {
        $this->recurringTransactionRepository = $recurringTransactionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Account $account)
    {
        return view('recurring-transactions.index', [
            'account'               => $account,
            'previous'              => true,
            'recurringTransactions' => $this->recurringTransactionRepository->getAllRecurringTransactions($account),
            'title'                 => 'Transacciones',
        ]);
    }

    public function create(Account $account)
    {
        return view('recurring-transactions.form', [
            'account'  => $account,
            'method'   => 'POST',
            'previous' => true,
            'route'    => route('recurring_transactions.store', $account),
            'title'    => 'Transacciones',
        ]);
    }

    public function store(StoreRecurringTransactionRequest $request)
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

        event(new ActivityEvent(
            $recurringTransaction,
            'recurring_transaction',
            'Transacción recurrente creada',
            'Se ha creado la transacción ' . $recurringTransaction->name,
            '/recurring_transactions/' . $recurringTransaction->id
        ));
        
        return redirect()->route('recurring_transactions.index', $recurringTransaction->account_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($recurringTransactionId)
    {
        return view('recurring-transactions.show', [
            'previous'             => true,
            'recurringTransaction' => $this->recurringTransactionRepository->getRecurringTransactionById(
                $recurringTransactionId
            ),
            'title'                => 'Transacciones',
        ]);
    }

    public function edit($recurringTransactionId)
    {
        return view('recurring-transactions.form', [
            'method'                => 'PUT',
            'previous'              => true,
            'recurringTransaction'  => $this->recurringTransactionRepository->getRecurringTransactionById(
                $recurringTransactionId
            ),
            'route'                 => route('recurring_transactions.update', $recurringTransactionId),
            'title'                 => 'Transacciones',
        ]);
    }

    public function update(RecurringTransaction $recurringTransaction, UpdateRecurringTransactionRequest $request)
    {
        $this->recurringTransactionRepository->updateRecurringTransaction(
            $recurringTransaction,
            $request->only([
                'category_id',
                'name',
                'description',
                'amount',
            ])
        );

        event(new ActivityEvent(
            $recurringTransaction,
            'recurring_transaction',
            'Transacción recurrente actualizada',
            'Se ha actualizado la transacción ' . $recurringTransaction->name,
            '/recurring_transactions/' . $recurringTransaction->id)
        );
        
        return redirect()->route('recurring_transactions.index', $recurringTransaction->account_id);
    }
}
