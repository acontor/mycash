<?php

namespace App\Interfaces;

interface TransactionRepositoryInterface
{
    public function getTransactionById($transactionId);
    public function createTransaction(array $transactionData);
    public function updateTransaction($transaction, array $transactionData);
    public function deleteTransaction($transactionId);
    public function createBalanceAccount($transaction);
    public function updateBalanceAccount($transaction, $befre_amount);
    public function deleteBalanceAccount($transaction);
}
