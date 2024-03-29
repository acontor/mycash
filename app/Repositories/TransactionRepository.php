<?php

namespace App\Repositories;

use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function createTransaction(array $transactionData): Transaction
    {
        return Transaction::create([
            'account_id'  => $transactionData['account_id'],
            'amount'      => $transactionData['amount'],
            'category_id' => $transactionData['category_id'],
            'date'        => $transactionData['date'],
            'description' => $transactionData['description'],
            'name'        => $transactionData['name'],
        ]);
    }

    public function updateTransaction(Transaction $transaction, array $transactionData): void
    {
        $transaction->update([
            'account_id'  => $transactionData['account_id'],
            'amount'      => $transactionData['amount'],
            'category_id' => $transactionData['category_id'],
            'date'        => $transactionData['date'],
            'description' => $transactionData['description'],
            'name'        => $transactionData['name'],
        ]);
    }

    public function deleteTransaction(Transaction $transaction): void
    {
        $transaction->delete();
    }

    public function createBalanceAccount(Transaction $transaction): void
    {
        $account = $transaction->account;
        $account->balance += $transaction->amount;
        $account->save();
    }

    public function updateBalanceAccount(Transaction $transaction, float $before_amount): void
    {
        $account = $transaction->account;
        $account->balance += $transaction->amount - $before_amount;
        $account->save();
    }

    public function deleteBalanceAccount(Transaction $transaction): void
    {
        $account = $transaction->account;
        $account->balance -= $transaction->amount;
        $account->save();
    }
}
