<?php

namespace App\Http\Controllers;

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
            'route'     => route('transactions.store'),
            'method'    => 'POST',
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
        $transactionData = $request->only([
            'name',
            'category_id',
            'account_id',
            'amount',
            'date',
            'description',
        ]);
        $transaction = $this->transactionRepository->createTransaction($transactionData);
        $this->transactionRepository->createBalanceAccount($transaction);
        $this->transactionRepository->createTransactionActivity($transaction, 'Transacción creada', 'Se ha creado la transacción ' . $transaction->name);
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
            'transaction' => $this->transactionRepository->getTransactionById($transaction)
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
            'route'       => route('transactions.update', $transaction->id),
            'method'      => 'PUT',
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
        $this->transactionRepository->createTransactionActivity($transaction, 'Transacción actualizada', 'Se ha actualizado la transacción ' . $transaction->name);
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
        $transaction->delete();
        $this->transactionRepository->deleteBalanceAccount($transaction);
        $this->transactionRepository->createTransactionActivity($transaction, 'Transacción eliminada', 'Se ha eliminado la transacción ' . $transaction->name);
        return redirect()->route('accounts.show', $transaction->account_id);
    }
}
