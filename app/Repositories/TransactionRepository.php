<?php

namespace App\Repositories;

use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;
use App\Models\Activity;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function getTransactionById($accountId)
    {
        return Transaction::findOrFail($accountId);
    }

    public function createTransaction(array $ransactionData)
    {
        return Transaction::create([
            'name'          => $ransactionData['name'],
            'category_id'   => $ransactionData['category_id'],
            'account_id'    => $ransactionData['account_id'],
            'amount'        => $ransactionData['amount'],
            'date'          => $ransactionData['date'],
            'description'   => $ransactionData['description'],
        ]);
    }

    public function updateTransaction($transaction, array $transactionData)
    {
        $transaction->update([
            'name'          => $transactionData['name'],
            'category_id'   => $transactionData['category_id'],
            'account_id'    => $transactionData['account_id'],
            'amount'        => $transactionData['amount'],
            'date'          => $transactionData['date'],
            'description'   => $transactionData['description'],
        ]);
    }

    public function deleteTransaction($transactionId)
    {
        Activity::whereTransactionId($transactionId)->delete();
        Transaction::destroy($transactionId);
    }

    public function createBalanceAccount($transaction)
    {
        $account = $transaction->account;
        $account->balance += $transaction->amount;
        $account->save();
    }

    public function updateBalanceAccount($transaction, $before_amount)
    {
        $account = $transaction->account;
        $account->balance += $transaction->amount - $before_amount;
        $account->save();
    }

    public function deleteBalanceAccount($transaction)
    {
        $account = $transaction->account;
        $account->balance -= $transaction->amount;
        $account->save();
    }

    public function createTransactionActivity($transaction, $name, $description)
    {
        return Activity::create([
            'name'          => $name,
            'description'   => $description,
            'user_id'       => auth()->user()->id,
            'type'          => 'transaction',
            'model_id'      => $transaction->id,
            'action'        => '/transactions/' . $transaction->id,
        ]);
    }
}
