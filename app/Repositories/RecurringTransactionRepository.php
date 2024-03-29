<?php

namespace App\Repositories;

use App\Interfaces\RecurringTransactionRepositoryInterface;
use App\Models\Account;
use App\Models\RecurringTransaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class RecurringTransactionRepository implements RecurringTransactionRepositoryInterface
{
    public function getAllRecurringTransactions(Account $account): Collection
    {
        return $account->recurring_transactions;
    }

    public function createRecurringTransaction(array $recurringTansactionData): RecurringTransaction
    {
        return RecurringTransaction::create([
            'account_id'  => $recurringTansactionData['account_id'],
            'amount'      => $recurringTansactionData['amount'],
            'description' => $recurringTansactionData['description'],
            'category_id' => $recurringTansactionData['category_id'],
            'frequency'   => $recurringTansactionData['frequency'],
            'name'        => $recurringTansactionData['name'],
            'next_date'   => $this->getNextDate($recurringTansactionData['start_date']),
            'remaining'   => $recurringTansactionData['remaining'],
            'start_date'  => $recurringTansactionData['start_date'],
        ]);
    }

    public function updateRecurringTransaction(
        RecurringTransaction $recurringTransaction,
        array $recurringTransactionData
    ): void {
        $recurringTransaction->update([
            'amount'      => $recurringTransactionData['amount'],
            'category_id' => $recurringTransactionData['category_id'],
            'description' => $recurringTransactionData['description'],
            'name'        => $recurringTransactionData['name'],
        ]);
    }

    private function getNextDate(string $startDate): string
    {
        return now()->diffInDays($startDate) > 0 ? $startDate : now();
    }
}
