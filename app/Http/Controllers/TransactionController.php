<?php

namespace App\Http\Controllers;

use App\Events\ActivityEvent;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;

class TransactionController extends Controller
{
    private TransactionRepositoryInterface $transactionRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
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

        event(new ActivityEvent(
            $transaction,
            'transaction',
            'Transacción creada',
            'Se ha creado la transacción '.$transaction->name,
            route('transactions.show', $transaction->id)
        ));
        
        return redirect()->route('accounts.show', $transaction->account_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($transaction)
    {
        return view('transactions.show', [
            'transaction' => $this->transactionRepository->getTransactionById($transaction),
            'title'       => 'Transacción',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
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

        event(new ActivityEvent(
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
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $this->transactionRepository->deleteTransaction($transaction->id);
        $this->transactionRepository->deleteBalanceAccount($transaction);

        event(new ActivityEvent(
            $transaction,
            'transaction',
            'Transacción eliminada',
            'Se ha eliminado la transacción ' . $transaction->name,
            ''
        ));

        return redirect()->route('accounts.show', $transaction->account_id);
    }
}
