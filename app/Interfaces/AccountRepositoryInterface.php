<?php

namespace App\Interfaces;

interface AccountRepositoryInterface
{
    public function getAllAccounts();
    public function getAccountById($accountId);
    public function createAccount(array $accountData);
    public function updateAccount($account, array $accountData);
    public function deleteAccount($accountId);
}
