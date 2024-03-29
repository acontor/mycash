<?php

namespace App\Policies;

use App\Models\Goal;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GoalPolicy
{
    /**
     * Determine whether the user can view the model.
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(User $user, Goal $goal): Response
    {
        return $user->id === $goal->account->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Goal $goal): Response
    {
        return $user->id === $goal->account->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Goal $goal): Response
    {
        return $user->id === $goal->account->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }
}
