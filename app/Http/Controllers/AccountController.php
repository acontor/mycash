<?php

namespace App\Http\Controllers;

use App\Events\ActivityEvent;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Interfaces\AccountRepositoryInterface;
use App\Models\Account;

class AccountController extends Controller
{
    private AccountRepositoryInterface $accountRepository;

    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('accounts.index', [
            'accounts' => $this->accountRepository->getAllAccounts(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($accountId)
    {
        return view('accounts.show', [
            'account' => $this->accountRepository->getAccountById($accountId),
        ]);
    }

    public function create()
    {
        return view('accounts.form', [
            'route'     => route('accounts.store'),
            'method'    => 'POST',
        ]);
    }

    public function store(StoreAccountRequest $request)
    {
        $accountData = $request->only([
            'name',
            'description',
            'balance',
            'category_id',
            'main',
        ]);
        $account = $this->accountRepository->createAccount($accountData);
        event(new ActivityEvent($account, 'account', 'Cuenta creada', 'Se ha creado la cuenta ' . $account->name, '/accounts/' . $account->id));
        return redirect()->route('accounts.index');
    }

    public function edit($accountId)
    {
        return view('accounts.form', [
            'route'     => route('accounts.update', $accountId),
            'method'    => 'PUT',
            'account'   => $this->accountRepository->getAccountById($accountId),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountRequest $request, Account $account)
    {
        $accountData = $request->only([
            'name',
            'description',
            'balance',
            'category_id',
            'main',
        ]);
        $this->accountRepository->updateAccount($account, $accountData);
        event(new ActivityEvent($account, 'account', 'Cuenta actualizada', 'Se ha actualizado la cuenta ' . $account->name, '/accounts/' . $account->id));
        return redirect()->route('accounts.index');
    }

    public function destroy(Account $account)
    {
        $this->accountRepository->deleteAccount($account);
        event(new ActivityEvent($account, 'account', 'Cuenta eliminada', 'Se ha eliminado la cuenta ' . $account->name, '/accounts/' . $account->id));
        return redirect()->route('accounts.index');
    }
}
