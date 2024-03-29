<?php

namespace App\Repositories;

use App\Interfaces\AccountRepositoryInterface;
use App\Models\Account;
use App\Models\RecurringTransaction;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;

class AccountRepository implements AccountRepositoryInterface
{
    public function getAllAccounts(): Collection
    {
        return auth()->user()->accounts;
    }

    public function getAccountsByType(string $type): Collection
    {
        return Account::where('user_id', auth()->id())->where('type', $type)->get();
    }

    public function getAccountById(int $accountId): Account
    {
        return Account::where('user_id', auth()->id())->findOrFail($accountId);
    }

    public function createAccount(array $accountData): Account
    {
        if (array_key_exists('main', $accountData)) {
            Account::where('user_id', auth()->id())->update(['main' => false]);
        }

        return Account::create([
            'balance'     => $accountData['balance'],
            'category_id' => $accountData['category_id'],
            'description' => $accountData['description'],
            'main'        => array_key_exists('main', $accountData) && $accountData['main'] == 'on' ? true : false,
            'name'        => $accountData['name'],
            'type'        => $accountData['type'],
            'user_id'     => auth()->user()->id,
        ]);
    }

    public function updateAccount(Account $account, array $accountData): void
    {
        if (array_key_exists('main', $accountData)) {
            Account::where('user_id', auth()->id())->update(['main' => false]);
        }

        $account->update([
            'category_id' => $accountData['category_id'],
            'description' => $accountData['description'],
            'name'        => $accountData['name'],
            'main'        => array_key_exists('main', $accountData) && $accountData['main'] == 'on' ? true : false,
        ]);
    }

    public function deleteAccount($accountId): void
    {
        Transaction::whereAccountId($accountId)->delete();
        RecurringTransaction::whereAccountId($accountId)->delete();
        Account::destroy($accountId);
    }
}
