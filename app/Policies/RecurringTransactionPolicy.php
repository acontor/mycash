<?php

namespace App\Policies;

use App\Models\RecurringTransaction;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RecurringTransactionPolicy
{
    /**
     * Determine whether the user can view the model.
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(User $user, RecurringTransaction $recurringTransaction): Response
    {
        return $user->id === $recurringTransaction->account->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RecurringTransaction $recurringTransaction): Response
    {
        return $user->id === $recurringTransaction->account->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RecurringTransaction $recurringTransaction): Response
    {
        return $user->id === $recurringTransaction->account->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }
}
