<?php

namespace App\Repositories;

use App\Interfaces\RecurringTransactionRepositoryInterface;
use App\Models\Activity;
use App\Models\RecurringTransaction;
use Illuminate\Database\Eloquent\Collection;

class RecurringTransactionRepository implements RecurringTransactionRepositoryInterface
{
    public function getAllRecurringTransactions($account): Collection
    {
        return $account->recurring_transactions;
    }

    public function getRecurringTransactionById($recurringTransactionId): RecurringTransaction
    {
        return RecurringTransaction::findOrFail($recurringTransactionId);
    }

    public function createRecurringTransaction(array $recurringTansactionData): RecurringTransaction
    {
        return RecurringTransaction::create([
            'name'          => $recurringTansactionData['name'],
            'description'   => $recurringTansactionData['description'],
            'category_id'   => $recurringTansactionData['category_id'],
            'account_id'    => $recurringTansactionData['account_id'],
            'amount'        => $recurringTansactionData['amount'],
            'frequency'     => $recurringTansactionData['frequency'],
            'start_date'    => $recurringTansactionData['start_date'],
            'remaining'     => $recurringTansactionData['remaining'],
            'next_date'     => $this->getNextDate($recurringTansactionData['start_date']),
        ]);
    }

    public function updateRecurringTransaction($recurringTransaction, array $recurringTransactionData)
    {
        $recurringTransaction->update([
            'name'          => $recurringTransactionData['name'],
            'category_id'   => $recurringTransactionData['category_id'],
            'amount'        => $recurringTransactionData['amount'],
            'description'   => $recurringTransactionData['description'],
        ]);
    }

    public function createRecurringTransactionActivity($recurringTransaction, $name, $description)
    {
        return Activity::create([
            'name'          => $name,
            'description'   => $description,
            'user_id'       => auth()->user()->id,
            'type'          => 'recurring_transaction',
            'model_id'      => $recurringTransaction->id,
            'action'        => '/transactions/' . $recurringTransaction->id,
        ]);
    }

    private function getNextDate($startDate)
    {
        return now()->diffInDays($startDate) > 0 ? $startDate : now();
    }
}
