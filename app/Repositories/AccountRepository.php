<?php

namespace App\Repositories;

use App\Interfaces\AccountRepositoryInterface;
use App\Models\Account;
use App\Models\RecurringTransaction;
use App\Models\Transaction;

class AccountRepository implements AccountRepositoryInterface
{
    public function getAllAccounts()
    {
        return auth()->user()->accounts;
    }

    public function getAccountById($accountId)
    {
        return Account::where('user_id', auth()->id())->findOrFail($accountId);
    }

    public function createAccount(array $accountData)
    {
        if (array_key_exists('main', $accountData)) {
            Account::where('user_id', auth()->id())->update(['main' => false]);
        }

        return Account::create([
            'name'        => $accountData['name'],
            'description' => $accountData['description'],
            'balance'     => $accountData['balance'],
            'category_id' => $accountData['category_id'],
            'user_id'     => auth()->user()->id,
            'main'        => array_key_exists('main', $accountData) && $accountData['main'] == 'on' ? true : false,
        ]);
    }

    public function updateAccount($account, array $accountData)
    {
        if (array_key_exists('main', $accountData)) {
            Account::where('user_id', auth()->id())->update(['main' => false]);
        }

        return $account->update([
            'name'        => $accountData['name'],
            'description' => $accountData['description'],
            'category_id' => $accountData['category_id'],
            'main'        => array_key_exists('main', $accountData) && $accountData['main'] == 'on' ? true : false,
        ]);
    }

    public function deleteAccount($accountId)
    {
        Transaction::whereAccountId($accountId)->delete();
        RecurringTransaction::whereAccountId($accountId)->delete();
        Account::destroy($accountId);
    }
}
