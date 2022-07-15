<?php

namespace App\Repositories;

use App\Interfaces\AccountRepositoryInterface;
use App\Models\Account;
use App\Models\Activity;

class AccountRepository implements AccountRepositoryInterface
{
    public function getAllAccounts()
    {
        return auth()->user()->accounts;
    }

    public function getAccountById($accountId)
    {
        return Account::findOrFail($accountId);
    }

    public function createAccount(array $accountData)
    {
        if (array_key_exists('main', $accountData)) {
            Account::where('user_id', auth()->id())->update(['main' => false]);
        }
        return Account::create([
            'name'          => $accountData['name'],
            'description'   => $accountData['description'],
            'balance'       => $accountData['balance'],
            'category_id'   => $accountData['category_id'],
            'user_id'       => auth()->user()->id,
            'main'          => array_key_exists('main', $accountData) && $accountData['main'] == 'on' ? true : false,
        ]);
    }

    public function updateAccount($account, array $accountData)
    {
        if (array_key_exists('main', $accountData)) {
            Account::where('user_id', auth()->id())->update(['main' => false]);
        }
        return $account->update([
            'name'          => $accountData['name'],
            'description'   => $accountData['description'],
            'category_id'   => $accountData['category_id'],
            'main'          => array_key_exists('main', $accountData) && $accountData['main'] == 'on' ? true : false,
        ]);
    }

    public function deleteAccount($accountId)
    {
        Activity::whereAccountId($accountId)->delete();
        Account::destroy($accountId);
    }

    public function createAccountActivity($account, $name, $description)
    {
        return Activity::create([
            'name'          => $name,
            'description'   => $description,
            'user_id'       => auth()->user()->id,
            'type'          => 'account',
            'model_id'      => $account->id,
            'action'        => '/accounts/' . $account->id,
        ]);
    }
}
