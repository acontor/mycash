<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AccountPolicy
{
    /**
     * Determine whether the user can view the model.
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(User $user, Account $account): Response
    {
        return $user->id === $account->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function viewNormal(User $user, Account $account): Response
    {
        return $user->id === $account->user_id && $account->type === 'Normal'
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function viewObjetivos(User $user, Account $account): Response
    {
        return $user->id === $account->user_id && $account->type === 'Objetivos'
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Account $account): Response
    {
        return $user->id === $account->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Account $account): Response
    {
        return $user->id === $account->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }
}
