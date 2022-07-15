<?php

namespace App\Interfaces;

use App\Models\RecurringTransaction;
use Illuminate\Database\Eloquent\Collection;

interface RecurringTransactionRepositoryInterface
{
    public function getAllRecurringTransactions($account): Collection;
    public function getRecurringTransactionById($recurringTransactionId): RecurringTransaction;
    public function createRecurringTransaction(array $recurringTansactionData): RecurringTransaction;
    public function updateRecurringTransaction($recurringTransaction, array $recurringTransactionData);
    public function createRecurringTransactionActivity($recurringTransaction, $name, $description);
}
