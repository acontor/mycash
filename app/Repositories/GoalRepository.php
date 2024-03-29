<?php

namespace App\Repositories;

use App\Interfaces\GoalRepositoryInterface;
use App\Models\Goal;

class GoalRepository implements GoalRepositoryInterface
{
    public function createGoal(array $goalData): Goal
    {
        return Goal::create([
            'account_id'  => $goalData['account_id'],
            'amount'      => $goalData['amount'],
            'category_id' => $goalData['category_id'],
            'contributed' => $goalData['contributed'],
            'description' => $goalData['description'],
            'end_date'    => $goalData['end_date'],
            'name'        => $goalData['name'],
            'spent'       => $goalData['spent'],
        ]);
    }

    public function updateGoal(Goal $goal, array $goalData): void
    {
        $goal->update([
            'account_id'  => $goalData['account_id'],
            'amount'      => $goalData['amount'],
            'category_id' => $goalData['category_id'],
            'contributed' => $goalData['contributed'],
            'description' => $goalData['description'],
            'end_date'    => $goalData['end_date'],
            'name'        => $goalData['name'],
            'spent'       => $goalData['spent'],
        ]);
    }

    public function deleteGoal(Goal $goal): void
    {
        $goal->delete();
    }
}
