<?php

namespace App\Http\Controllers;

use App\Events\ActivityEvent;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Interfaces\AccountRepositoryInterface;
use App\Models\Account;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AccountController extends Controller
{
    public function __construct(
        private AccountRepositoryInterface $accountRepository
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('accounts.index', [
            'accounts'     => $this->accountRepository->getAccountsByType('Normal'),
            'goalAccounts' => $this->accountRepository->getAccountsByType('Objetivos'),
            'titleRight'   => 'Cuentas'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Account $account
     *
     * @return View
     */
    public function show(Account $account): View
    {
        $this->authorize('view', $account);

        if ($account->type == 'Objetivos') {
            return view('accounts.goals.show', [
                'account'    => $account,
                'titleRight' => $account->name,
            ]);
        }

        return view('accounts.show', [
            'account'    => $account,
            'titleRight' => $account->name,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('accounts.form', [
            'method'     => 'POST',
            'route'      => route('accounts.store'),
            'titleRight' => 'Nueva cuenta',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAccountRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreAccountRequest $request): RedirectResponse
    {
        $account = $this->accountRepository->createAccount(
            $request->only([
                'name',
                'description',
                'balance',
                'category_id',
                'main',
                'type',
            ])
        );

        event(new ActivityEvent(
            $account,
            'account',
            'Cuenta creada',
            'Se ha creado la cuenta '.$account->name,
            route('accounts.show', $account->id)
        ));

        return redirect()->route('accounts.show', $account->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Account $account
     *
     * @return View
     */
    public function edit(Account $account): View
    {
        $this->authorize('update', $account);

        return view('accounts.form', [
            'account'    => $account,
            'method'     => 'PUT',
            'route'      => route('accounts.update', $account->id),
            'titleRight' => 'Editar cuenta'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateAccountRequest $request
     * @param  Account              $account
     *
     * @return RedirectResponse
     */
    public function update(UpdateAccountRequest $request, Account $account): RedirectResponse
    {
        $this->authorize('update', $account);

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

    /**
     * Remove the specified resource from storage.
     *
     * @param Account $account
     *
     * @return RedirectResponse
     */
    public function destroy(Account $account): RedirectResponse
    {
        $this->authorize('delete', $account);

        $this->accountRepository->deleteAccount($account);

        event(new ActivityEvent(
            $account,
            'account',
            'Cuenta eliminada',
            'Se ha eliminado la cuenta '.$account->name.' y todas sus transacciones',
            ''
        ));

        return redirect()->route('accounts.index');
    }
}
