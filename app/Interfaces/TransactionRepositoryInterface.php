<?php

namespace App\Interfaces;

use App\Models\Transaction;

interface TransactionRepositoryInterface
{
    public function createTransaction(array $transactionData): Transaction;
    public function updateTransaction(Transaction $transaction, array $transactionData): void;
    public function deleteTransaction(int $transactionId): void;
    public function createBalanceAccount(Transaction $transaction): void;
    public function updateBalanceAccount(Transaction $transaction, float $before_amount): void;
    public function deleteBalanceAccount(Transaction $transaction): void;
}
