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
            'title'    => 'Cuentas'
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
            'account'  => $this->accountRepository->getAccountById($accountId),
            'previous' => true,
            'title'    => 'Cuentas'
        ]);
    }

    public function create()
    {
        return view('accounts.form', [
            'method'   => 'POST',
            'previous' => true,
            'route'    => route('accounts.store'),
            'title'    => 'Cuentas'
        ]);
    }

    public function store(StoreAccountRequest $request)
    {
        $account = $this->accountRepository->createAccount(
            $request->only([
                'name',
                'description',
                'balance',
                'category_id',
                'main',
            ])
        );

        event(new ActivityEvent(
            $account,
            'account',
            'Cuenta creada',
            'Se ha creado la cuenta ' . $account->name,
            route('accounts.show', $account->id)
        ));

        return redirect()->route('accounts.index');
    }

    public function edit($accountId)
    {
        return view('accounts.form', [
            'account'  => $this->accountRepository->getAccountById($accountId),
            'method'   => 'PUT',
            'previous' => true,
            'route'    => route('accounts.update', $accountId),
            'title'    => 'Cuentas'
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
        $this->accountRepository->updateAccount(
            $account,
            $request->only([
                'name',
                'description',
                'balance',
                'category_id',
                'main',
            ])
        );

        event(new ActivityEvent(
            $account,
            'account',
            'Cuenta actualizada',
            'Se ha actualizado la cuenta '.$account->name,
            route('accounts.show', $account->id)
        ));

        return redirect()->route('accounts.index');
    }

    public function destroy(Account $account)
    {
        $this->accountRepository->deleteAccount($account);

        event(new ActivityEvent(
            $account,
            'account',
            'Cuenta eliminada',
            'Se ha eliminado la cuenta '.$account->name,
            route('accounts.show', $account->id)
        ));

        return redirect()->route('accounts.index');
    }
}
