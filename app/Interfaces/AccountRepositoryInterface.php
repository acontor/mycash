<?php

namespace App\Interfaces;

use App\Models\Account;
use Illuminate\Database\Eloquent\Collection;

interface AccountRepositoryInterface
{
    public function getAllAccounts(): Collection;
    public function getAccountsByType(string $type): Collection;
    public function getAccountById(int $accountId): Account;
    public function createAccount(array $accountData): Account;
    public function updateAccount(Account $account, array $accountData): void;
    public function deleteAccount(Account $accountId): void;
}
