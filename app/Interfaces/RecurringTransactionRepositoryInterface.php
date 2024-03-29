<?php

namespace App\Interfaces;

use App\Models\Account;
use App\Models\RecurringTransaction;
use Illuminate\Database\Eloquent\Collection;

interface RecurringTransactionRepositoryInterface
{
    public function getAllRecurringTransactions(Account $account): Collection;
    public function createRecurringTransaction(array $recurringTansactionData): RecurringTransaction;
    public function updateRecurringTransaction(
        RecurringTransaction $recurringTransaction,
        array $recurringTransactionData
    ): void;
}
