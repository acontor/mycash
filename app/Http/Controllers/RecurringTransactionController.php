<?php

namespace App\Http\Controllers;

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
            'account' => $account,
            'recurringTransactions' => $this->recurringTransactionRepository->getAllRecurringTransactions($account),
        ]);
    }

    public function create(Account $account)
    {
        return view('recurring-transactions.form', [
            'route'     => route('recurring_transactions.store', $account),
            'method'    => 'POST',
            'account'   => $account,
        ]);
    }

    public function store(StoreRecurringTransactionRequest $request)
    {
        $recurringTransactionData = $request->only([
            'account_id',
            'category_id',
            'name',
            'description',
            'frequency',
            'amount',
            'start_date',
        ]);
        $recurringTransaction = $this->recurringTransactionRepository->createRecurringTransaction($recurringTransactionData);
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
            'recurringTransaction' => $this->recurringTransactionRepository->getRecurringTransactionById($recurringTransactionId)
        ]);
    }

    public function edit($recurringTransactionId)
    {
        return view('recurring-transactions.form', [
            'route'                 => route('recurring_transactions.update', $recurringTransactionId),
            'method'                => 'PUT',
            'recurringTransaction'  => $this->recurringTransactionRepository->getRecurringTransactionById($recurringTransactionId)
        ]);
    }

    public function update(RecurringTransaction $recurringTransaction, UpdateRecurringTransactionRequest $request)
    {
        $recurringTransactionData = $request->only([
            'category_id',
            'name',
            'description',
            'amount',
        ]);
        $this->recurringTransactionRepository->updateRecurringTransaction($recurringTransaction, $recurringTransactionData);
        return redirect()->route('recurring_transactions.index', $recurringTransaction->account_id);
    }
}
