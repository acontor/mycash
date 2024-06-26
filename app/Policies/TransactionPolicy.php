<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TransactionPolicy
{
    /**
     * Determine whether the user can view the model.
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(User $user, Transaction $transaction): Response
    {
        return $user->id === $transaction->account->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Transaction $transaction): Response
    {
        return $user->id === $transaction->account->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Transaction $transaction): Response
    {
        return $user->id === $transaction->account->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }
}
